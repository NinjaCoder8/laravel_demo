<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Question;

class QuestionController extends Controller{
    
    function getQuestions($count, $page, $id = null){

        if($id == null){
            $questions = Question::paginate($count, ['*'], 'page', $page);
            return response()->json([
                "success" => "true",
                "questions" => $questions
            ]);
        }

        $question = Question::find($id);

        if($question){
            return response()->json([
                "success" => "true",
                "questions" => $question
            ]);
        }
    
        return response()->json([
            "success" => "false",
            "questions" => null
        ]);
    }

    function addOrUpdateQuestion(Request $request, $id = "add"){
        if($id == "add"){
            $question = new Question;
        }else{
            $question = Question::find($id);
            if(!$question){
                return response()->json([
                    "success" => "false",
                    "questions" => null
                ]);
            }
        }

        $question->title = $request["title"];
        $question->answer = $request["answer"];
        $question->save();

        return response()->json([
            "success" => "true",
            "questions" => $question
        ]);
    }
}

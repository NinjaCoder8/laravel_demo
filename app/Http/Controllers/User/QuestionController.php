<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Profile;
use App\Models\Question;
use App\Models\Department;

class QuestionController extends Controller{
    

    function test2(){
        //$department = Department::find(1);
        //$users = Department::find(1)->users;
        $users = Department::find(1)->users()->createdToday()->byAdmin()->get();

        //$users = User::byAdmin()->get();

        return response()->json([
            "success" => "true",
            "users" => $users
        ]);
    }


    function test1(){
        //$profile = Profile::with("user")->find(1);
        $user = User::with("profile")->find(2);
        //$user = User::where("id", 2)->get(); //<- returns array
        //$user = User::with("profile")->where("id", 2)->first(); //<- returns object 

        //$profile = $user->profile;

        return response()->json([
            "success" => "true",
            "user" => $user
        ]);
    }


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

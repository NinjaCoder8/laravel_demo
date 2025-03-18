<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller{
    
    function login(Request $request){
        $credentials = [
            "email" => $request["email"], 
            "password"=> $request["password"]
        ];

        if (! $token = Auth::attempt($credentials)) {
            return response()->json([
                "success" => false,
                "error" => "Unauthorized"
            ], 401);
        }

        $user = Auth::user();
        $user->token = $token;

        return response()->json([
            "success" => true,
            "user" => $user
        ]);
    }

    function signup(Request $request){
        $user = new User; 
        $user->full_name = "Hard Coded";
        $user->username = "Hard Coded";
        $user->email = $request["email"];
        $user->password = bcrypt($request["password"]);
        $user->save();

        return response()->json([
            "success" => true
        ]);
    }

    function editProfile(Request $request){
        $user = Auth::user();

        $user->full_name = $request["full_name"] ? $request["full_name"] : $user->full_name;
        $user->username = $request["username"] ? $request["username"] : $user->username;
        $user->email = $request["email"] ? $request["email"] : $user->email;
        
        $user->save();

        return response()->json([
            "success" => true,
            "user" => $user
        ]);
    }
}

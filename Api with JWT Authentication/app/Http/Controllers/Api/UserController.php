<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Lcobucci\JWT\Token;

class UserController extends Controller
{
    //Useer Register Api - Post
    public function register(Request $request){

        //Validation
        $request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:users",
            "phone_no"=>"required",
            "password"=>["required", "confirmed"]
        ]);
        //Create & Save
        $user = new user();

        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone_no=$request->phone_no;
        $user->password=bcrypt($request->password);

        $user->save();


        //Response
        return response()->json([
            "status"=>1,
            "message"=>"User Successfully Created"
        ],200);
    }

    //User Login Api - Post
    public function login(Request $request){
        //Validate
        $request->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);
        //verify user and tokens
        if(!$token=auth()->attempt(["email"=>$request->email, "password"=>$request->password])){

            return response()->json([
                "status"=>0,
                "message"=>"Invalid Credentials"
            ],400);
        }
        return response()->json([
            "status"=>1,
            "message"=>"Logged in successfully",
            "access_token"=>  $this->createNewToken($token)

        ],200);
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            // 'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60,
            // 'user' => auth()->user()
        ]);
    }

    //User Profile Api - Get
    public function profile(){
        $user_data = auth()->user();
        return response()->json([
            "status" => 1,
            "message" =>"Profile View",
            "data" => $user_data
        ],200);

    }

    //User Logout Api - Get
    public function logout(){
        auth()->logout();
        return response()->json([
            "status"=> 1,
            "message"=>"User logged out"
        ],200);

    }
}


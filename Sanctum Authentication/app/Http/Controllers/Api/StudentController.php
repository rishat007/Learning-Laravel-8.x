<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use Illuminate\Auth\TokenGuard;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //Register Api
    public function register(Request $request){
        //Validate
        $request -> validate([
            "name"=>"required",
            "email"=>"required|email|unique:students",
            "password"=>"required|confirmed"
        ]);

        //Create
        $student = new Student();

        $student -> name = $request ->name;
        $student -> email = $request ->email;
        $student -> password = Hash::make($request->password);
        $student -> phone_no = isset($request->phone_no)? $request ->phone_no:"";

        $student->save();

        //Send Response
        return response()->json([
            "status"=>1,
            "message"=>"Student Successfully Added"
        ],200);
    }
    //Login Api
    public function login(Request $request){
        //Validate
        $request -> validate([
            "email"=> ['required', "email"],
            "password"=>["required"]
        ]);
        //Check Studen
        $student = Student::where("email", "=", $request->email)->first();
        if(isset($student->id)){
            if(Hash::check($request->password, $student->password)){

            //Create a Token
            $token = $student->createToken("auth_token")->plainTextToken;

            // $token = $student->createToken("auth_token");
            // $token = $token->plainTextToken;

            //send Response
                return response()->json([
                    "status"=>1,
                    "message"=>"Student Logged in Successfully",
                    "access_token"=>$token
                ],200);

            }else{
                return response()->json([
                    "status"=>0,
                    "messege"=>"Password Doesn't Match"
                ],404);
            }

        //send Response
        }else{
            return response()->json([
                "staus"=>0,
                "message"=>"Student Not Found"
            ],400);

        }


    }
    //Profile Api
    public function profile(){
        return response()->json([
            "status"=> 1,
            "message"=> "Student Profile",
            "data"=> auth()->user()
        ],200);
    }
    //Logout Api
    public function logout(){
        request()->user()->tokens()->delete();
        return response()->json([
            "status"=>1,
            "message"=>"Student Logged out Successfully"
        ],200);
    }


}

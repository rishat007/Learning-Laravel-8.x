<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;

class ProjectController extends Controller
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
    //Create Project Api
    public function createProject(Request $request){
        //validation
        $request -> validate([
            "name"=> "required",
            "description" => "required",
            "duration" => "required"
        ]);
        //student_id + cre(ate data
        $student_id = auth()-> user()->id;

        $project = new Project();
        $project -> student_id = $student_id;
        $project -> name = $request->name;
        $project -> description = $request -> description;
        $project -> duration = $request->duration;

        $project -> save();


        //send response
        return response()->json([
            "status"=>1,
            "message"=>"Project Created Successfully"
        ],200);
    }
    //List Project Api
    public function listProjects(){
        $student_id = auth()->user()->id;
        $projects = project::Where("student_id", $student_id)->get();
    //send Response
    return response()->json([
        "status"=>1,
        "message"=>  "Project List",
        "data"=> $projects
    ],200);

    }
    //Single Project Api
    public function singleProject($id){
        $student_id = auth()->user()->id;

        if(Project::where(["id"=>$id, "student_id"=>$student_id])->exists()){
            $details= Project::where(["id"=>$id,"student_id"=>$student_id])->first();

            return response()->json([
                "status"=>1,
                "message"=>"Project Details",
                "data"=>$details
            ],200);
        }else{
            return response()->json([
                "status"=>0,
                "message"=>"Project not Found",
            ],400);
        }

    }
    //Delete Project Api
    public function deleteProject($id){
        $student_id = auth()->user()->id;

        if(Project::where(["id"=>$id, "student_id"=>$student_id])->exists()){

            $project = Project::where(["id"=>$id, "student_id"=>$student_id])->first();
            $project->delete();

            return response()->json([
                "status"=>1,
                "message"=>"Project hasbeen deleted Successfully"
            ],200);
        }else{
            return response()->json([
                "staus"=>0,
                "message"=>"Project not Fount"

            ],400);
        }
    }
}

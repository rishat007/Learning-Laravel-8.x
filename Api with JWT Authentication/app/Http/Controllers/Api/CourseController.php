<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;

class CourseController extends Controller
{
    // Course Enrollment Api - Post
    public function courseEnrollment(Request $request){
        //Validation
        $request->validate([
            "title"=>"required",
            "description"=>"required",
            "total_videos"=>"required"
        ]);

        //Create Course object
        $course = new Course();

        $course->user_id = auth()->user()->id;
        $course->title= $request->title;
        $course->description=$request->description;
        $course->total_videos=$request->total_videos;

        $course->save();

        //Response
        return response()->json([
            "status"=> 1,
            "message"=> "Course Enrolled Successfully"
        ]);

    }

    //Total Course Enrollment Api - Get
    public function totalCourses(){
        $id = auth()->user()->id;

        $courses = User::find($id)->courses;
        // dd($courses)
        return response()->json([
            "status"=>1,
            "message"=>"Total Course Enrolled",
            "data"=>$courses
        ]);

    }

    //Delete Course Api - Get
    public function deleteCourse($id){
        $user_id = auth()->user()->id;
        if(Course::where([
            "id"=>$id,
            "user_id"=>$user_id
        ])->exists()){
            $course = Course::find($id);
            $course->delete();
            return response()->json([
                "status"=>1,
                "message"=>"Course deleted successfully"
            ]);

        }else{
            return response()->json([
                "status"=>0,
                "message"=>"Course not found"
            ]);
        }
    }
}

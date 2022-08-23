<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //CREATE API POST
    public function createEmployee(Request $request){
        //Validate
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "phone_no"=>"required",
            "gender"=>"required",
            "age"=>"required"
        ]);

        //Create data
        $employee = new Employee();

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone_no = $request->phone_no;
        $employee->gender = $request->gender;
        $employee->age = $request->age;

        $employee->save();
        //Send Response
        return response()->json([
            "status"=>1,
            "message"=>" Employee Successfully Created"
        ]);
    }

     //LIST API GET
     public function listEmployee(){
        $employees = Employee::get();

        // print_r($employees);
        return response()->json([
            "status"=>1,
            "message"=>"Employee Listing",
            "data"=>$employees
        ],200);

    }

    //SINGLE DETAILS API GET
    public function getSingleEmployee($id){

        if(Employee::Where("id", $id)->exists()){
            $employee_details = Employee::where("id", $id)->first();
            return response()->json([
                "status"=>1,
                "message"=>"Employee Found",
                "data"=>$employee_details

            ], 200);
        }else{
            return response()->json([
                "status"=>0,
                "message"=>"Employee not found",

            ], 404);
        }

    }

    //UPDATE API PUT
    public function updateEmployee(Request $request, $id){
        if(Employee::where("id",$id)->exists()){
            $employee=Employee::find($id);

            $employee->name=!empty($request->name) ? $request->name : $employee->name;
            $employee->email=!empty($request->email) ? $request->email : $employee->email;
            $employee->phone_no=!empty($request->pone_no) ? $request->phone_no : $employee->phone_no;
            $employee->gender=!empty($request->gender) ? $request->gender : $employee->gender;
            $employee->age=!empty($request->age) ? $request->age : $employee->age;

            $employee-> save();
            return response()->json([
                "status"=>1,
                "message"=>"Employee updated successfully"
            ], 200);
        }else{
            return response()->json([
                "status"=>0,
                "message"=>"Employee not found"
            ],404);
        }

    }

    //DELETE API DELETE
    public function deleteEmployee($id){
        if(Employee::Where("id",$id)->exists()){
            $employee=Employee::find($id);
            $employee->delete();

            return response()->json([
                "status"=>1,
                "message"=>"Employee Deleted successfully"
            ],200);
        }else{
            return response()->json([
                "status"=>0,
                "message"=>"Employee not found"
            ],404);
        }

    }

}

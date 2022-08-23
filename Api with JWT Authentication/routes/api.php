<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use  App\Http\Controllers\Api\CourseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::group([

//     'middleware' => 'api',
//     'namespace' => 'App\Http\Controllers',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('login', 'AuthController@login');
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::post('me', 'AuthController@me');
// });


Route::post("register", [UserController::class, "register"]);
Route::post("login",[UserController::class, "login"]);

Route::group(["middleware" => ["auth:api"]], function(){

    Route::post("logout",[UserController::class, "logout"]);
    Route::get("profile",[UserController::class, "profile"]);

    Route::Post("course-enrol",[CourseController::class,"courseEnrollment"]);
    Route::get("total-course",[CourseController::class, "totalCourses"]);
    Route::get("delete/{id}",[CourseController::class, "deleteCourse"]);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

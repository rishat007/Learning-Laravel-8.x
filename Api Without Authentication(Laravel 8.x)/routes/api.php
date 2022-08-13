<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\http\Controllers\ApiController;
use Illuminate\Http\Controllers\ApiEmployeeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

//API Without Authentication
// Route::get("list-employees",[\App\Http\Controllers\Api\ApiController::class, "listEmployee"]);
// Route::get("single-employee/{id}",[\App\Http\Controllers\Api\ApiController::class, "getSingleEmployee"]);
// Route::put("update-employee/{id}",[\App\Http\Controllers\Api\ApiController::class, "updateEmployee"]);
// Route::delete("delete-employee/{id}",[\App\Http\Controllers\Api\ApiController::class, "deleteEmployee"]);
// Route::post("add-employee",[\App\Http\Controllers\Api\ApiController::class, "createEmployee"]);

Route::get("list-employees",[\App\Http\Controllers\Api\ApiEmployeeController::class, "index"]);
Route::get("single-employee/{id}",[\App\Http\Controllers\Api\ApiEmployeeController::class, "show"]);
Route::put("update-employee/{id}",[\App\Http\Controllers\Api\ApiEmployeeController::class, "update"]);
Route::delete("delete-employee/{id}",[\App\Http\Controllers\Api\ApiEmployeeController::class, "destroy"]);
Route::post("add-employee",[\App\Http\Controllers\Api\ApiEmployeeController::class, "store"]);




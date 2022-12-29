<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestController;
use App\Http\Controllers\TaskController;
use App\Models\Person;
use App\Models\Addtask;
use App\Models\Task;

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

// Route::post('fill',[RestController::class,'store']);
// Route::post('login',[RestController::class,'logged']);

    Route::post('reg',[taskController::class,'task']);  
    Route::post('log',[taskController::class,'match']);

    Route::middleware('auth:api')->group(function () {
    Route::post('addtask/{match_id?}', [taskController::class, 'add1']); 
    Route::get('grouped', [taskController::class, 'taskgrp']); 
    Route::get('getted/{date}', [taskController::class, 'gett']); 
    Route::get('storing/{match_id}', [taskController::class, 'store']); 
    Route::get('remove/{match_id}', [taskController::class, 'clear']); 
    Route::get('alluser/{date}', [taskController::class, 'list']); 
    });
    // Route::post('forgotpassword',[taskController::class,'forgot']);


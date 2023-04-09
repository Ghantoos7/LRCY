<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(["prefix" => "v0.1"], function(){

    Route::group(["prefix" => "user"], function(){

        Route::post("signup", [UserController::class, "signup"]);
        Route::post("login", [UserController::class, "login"]);
        Route::post("register", [UserController::class, "register"]);
        Route::post("recover_request", [UserController::class, "recover_request"]);
        Route::post("change_password", [UserController::class, "change_password"]);
        Route::post("edit_profile", [UserController::class, "edit_profile"]);
        Route::get("get_user_info/{user_id?}", [UserController::class, "get_user_info"]);
        Route::get("get_trainings_info/{user_id}", [UserController::class, "get_trainings_info"]); 
        Route::get("get_volunteering_time/{user_id}", [UserController::class, "get_total_volunteering_time"]); //
        Route::get("get_posts_count/{user_id?}", [UserController::class, "get_posts_count"]);
        Route::get("get_comments_count/{user_id}", [UserController::class, "get_comments_count"]);
        Route::get("get_likes_received_count/{user_id}", [UserController::class, "get_total_likes_received"]);
        Route::get("get_events_organized/{user_id}", [UserController::class, "get_events_organized"]);
        Route::get("get_organized_events_count/{user_id}", [UserController::class, "get_organized_events_count"]);
        Route::get("get_own_posts/{user_id}", [UserController::class, "get_own_posts"]);
        Route::get("get_completed_trainings_count/{user_id}", [UserController::class, "get_completed_trainings_count"]);
    });

    

});
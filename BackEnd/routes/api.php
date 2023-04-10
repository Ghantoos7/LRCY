<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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
        Route::get("get_events_organized/{user_id}", [UserController::class, "get_events_organized"]);
        Route::get("get_events_organized_count/{user_id}", [UserController::class, "get_events_organized_count"]);
        Route::get("get_total_volunteering_time/{user_id}", [UserController::class, "get_total_volunteering_time"]); 
        Route::get("get_completed_trainings_count/{user_id}", [UserController::class, "get_completed_trainings_count"]);
        Route::get("get_posts_count/{user_id?}", [UserController::class, "get_posts_count"]);
        Route::get("get_comments_count/{user_id}", [UserController::class, "get_comments_count"]);
        Route::get("get_total_likes_received/{user_id}", [UserController::class, "get_total_likes_received"]);
        Route::get("get_own_posts/{user_id}", [UserController::class, "get_own_posts"]);
    });

    Route::group(["prefix" => "post"], function(){
        Route::post("create_post", [PostController::class, "create_post"]);
        Route::post("edit_post", [PostController::class, "edit_post"]);
        Route::post("delete_post", [PostController::class, "delete_post"]);
        Route::get("get_posts/{post_id?}", [PostController::class, "get_posts"]);
        Route::post("like_post", [PostController::class, "like_post"]);
        Route::post("unlike_post", [PostController::class, "unlike_post"]);
        Route::post("comment_post/{user_id}", [PostController::class, "comment_post"]);
        Route::post("reply/{user_id}", [PostController::class, "reply"]);
        Route::post("like_comment/{user_id}", [PostController::class, "like_comment"]);
        Route::post("unlike_comment/{user_id}", [PostController::class, "unlike_comment"]);
        Route::post("delete_comment/{user_id}", [PostController::class, "delete_comment"]);
        Route::post("delete_reply/{user_id}", [PostController::class, "delete_reply"]);
        Route::post("edit_comment/{user_id}", [PostController::class, "edit_comment"]);
        Route::post("edit_reply",[PostController::class, "edit_reply"]);
        Route::get("get_comments/{post_id}", [PostController::class, "get_comments"]);
        Route::get("get_replies/{comment_id}", [PostController::class, "get_replies"]);
        Route::get("get_likes/{post_id}", [PostController::class, "get_likes"]);
        Route::get("get_comments_likes/{comment_id}", [PostController::class, "get_comments_likes"]);
        Route::get("get_post_likes/{post_id}", [PostController::class, "get_post_likes"]);

    });

});
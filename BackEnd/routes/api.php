<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;

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
        Route::get("get_user_info/{user_id?}", [UserController::class, "get_user_info"]); // age
        Route::get("get_trainings_info/{user_id}", [UserController::class, "get_trainings_info"]); //
        Route::get("get_events_organized/{user_id}", [UserController::class, "get_events_organized"]); //
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
        Route::post("comment_post", [PostController::class, "comment_post"]);
        Route::post("reply_comment", [PostController::class, "reply_comment"]);
        Route::post("like_comment", [PostController::class, "like_comment"]);
        Route::post("unlike_comment", [PostController::class, "unlike_comment"]);
        Route::post("delete_comment", [PostController::class, "delete_comment"]);
        Route::post("delete_reply", [PostController::class, "delete_reply"]);
        Route::post("edit_comment", [PostController::class, "edit_comment"]);
        Route::post("edit_reply",[PostController::class, "edit_reply"]);
        Route::get("get_comments/{post_id}", [PostController::class, "get_comments"]);
        Route::get("get_replies/{comment_id}", [PostController::class, "get_replies"]);
        Route::get("get_post_likes/{post_id}", [PostController::class, "get_post_likes"]);
        Route::get("get_comment_likes/{comment_id}", [PostController::class, "get_comment_likes"]);
    });

    Route::group(["prefix" => "event"], function(){
        Route::get("get_yearly_goals/{year?}", [EventController::class, "get_yearly_goals"]);
        Route::get("get_event_info/{event_id?}", [EventController::class, "get_event_info"]);
        Route::get("get_announcements", [EventController::class, "get_announcements"]);
        Route::get("get_event_pictures/{event_id}", [EventController::class, "get_event_pictures"]);

    });

     Route::group(["prefix" => "admin"], function(){
        Route::post("login", [AdminController::class, "admin_login"]);
        Route::post("accept_request", [AdminController::class, "accept_request"]);
        Route::post("decline_request", [AdminController::class, "decline_request"]);
        Route::post("add_user", [AdminController::class, "add_user"]);
        Route::post("edit_user", [AdminController::class, "edit_user"]);
        Route::post("delete_user", [AdminController::class, "delete_user"]);
        Route::post("send_announcement", [AdminController::class, "send_announcement"]);
        Route::post("delete_announcement", [AdminController::class, "delete_announcement"]);
        Route::post("edit_announcement", [AdminController::class, "edit_announcement"]);
        Route::post("add_event", [AdminController::class, "add_event"]);
        Route::post("edit_event", [AdminController::class, "edit_event"]);
        Route::post("delete_event", [AdminController::class, "delete_event"]); 
        Route::post("set_yearly_goal", [AdminController::class, "set_yearly_goal"]);
        Route::post("edit_yearly_goal", [AdminController::class, "edit_yearly_goal"]);
        Route::post("delete_yearly_goal", [AdminController::class, "delete_yearly_goal"]);
    });


});
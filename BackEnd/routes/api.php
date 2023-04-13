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

Route::middleware('auth:jwt')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["prefix" => "v0.1"], function(){

    Route::group(["prefix" => "user"], function(){
        Route::post("signup", [UserController::class, "signup"]);
        Route::post("login", [UserController::class, "login"]);
        Route::post("register", [UserController::class, "register"]);
        Route::post("recover_request", [UserController::class, "recoverRequest"]);
        Route::post("change_password", [UserController::class, "changePassword"]);
        Route::post("edit_profile", [UserController::class, "editProfile"]);
        Route::get("get_user_info/{user_id?}", [UserController::class, "getUserInfo"]); 
        Route::get("get_trainings_info/{user_id}", [UserController::class, "getTrainingsInfo"]); 
        Route::get("get_events_organized/{user_id}", [UserController::class, "getEventsOrganized"]);
        Route::get("get_events_organized_count/{user_id}", [UserController::class, "getEventsOrganizedCount"]);
        Route::get("get_total_volunteering_time/{user_id}", [UserController::class, "getTotalVolunteeringTime"]); 
        Route::get("get_completed_trainings_count/{user_id}", [UserController::class, "getCompletedTrainingsCount"]);
        Route::get("get_posts_count/{user_id?}", [UserController::class, "getPostsCount"]);
        Route::get("get_comments_count/{user_id}", [UserController::class, "getCommentsCount"]);
        Route::get("get_total_likes_received/{user_id}", [UserController::class, "getTotalLikesReceived"]);
        Route::get("get_own_posts/{user_id}", [UserController::class, "getOwnPosts"]);
    });

    Route::group(["prefix" => "post"], function(){
        Route::post("create_post", [PostController::class, "createPost"]);
        Route::post("edit_post", [PostController::class, "editPost"]);
        Route::post("delete_post", [PostController::class, "deletePost"]);
        Route::get("get_posts/{post_id?}", [PostController::class, "getPosts"]);
        Route::post("like_post", [PostController::class, "likePost"]);
        Route::post("unlike_post", [PostController::class, "unlikePost"]);
        Route::post("comment_post", [PostController::class, "commentPost"]);
        Route::post("reply_comment", [PostController::class, "replyComment"]);
        Route::post("like_comment", [PostController::class, "likeComment"]);
        Route::post("unlike_comment", [PostController::class, "unlikeComment"]);
        Route::post("delete_comment", [PostController::class, "deleteComment"]);
        Route::post("delete_reply", [PostController::class, "deleteReply"]);
        Route::post("edit_comment", [PostController::class, "editComment"]);
        Route::post("edit_reply",[PostController::class, "editReply"]);
        Route::get("get_comments/{post_id}", [PostController::class, "getComments"]);
        Route::get("get_replies/{comment_id}", [PostController::class, "getReplies"]);
        Route::get("get_post_likes/{post_id}", [PostController::class, "getPostLikes"]);
        Route::get("get_comment_likes/{comment_id}", [PostController::class, "getCommentLikes"]);
    });

    Route::group(["prefix" => "event"], function(){
        Route::get("get_yearly_goals/{year?}", [EventController::class, "getYearlyGoals"]);
        Route::get("get_event_info/{event_id?}", [EventController::class, "getEventInfo"]);
        Route::get("get_announcements", [EventController::class, "getAnnouncements"]);
        Route::get("get_event_pictures/{event_id}", [EventController::class, "getEventPictures"]);

    });

     Route::group(["prefix" => "admin"], function(){
        Route::post("login", [AdminController::class, "adminLogin"]);
        Route::post("add_user", [AdminController::class, "addUser"]);
        Route::post("edit_user", [AdminController::class, "editUser"]);
        Route::post("delete_user", [AdminController::class, "deleteUser"]);
        Route::post("accept_request", [AdminController::class, "acceptRequest"]);
        Route::post("decline_request", [AdminController::class, "declineRequest"]);
        Route::post("send_announcement", [AdminController::class, "sendAnnouncement"]);
        Route::post("delete_announcement", [AdminController::class, "deleteAnnouncement"]);
        Route::post("edit_announcement", [AdminController::class, "editAnnouncement"]);
        Route::post("add_event", [AdminController::class, "addEvent"]);
        Route::post("edit_event", [AdminController::class, "editEvent"]);
        Route::post("delete_event", [AdminController::class, "deleteEvent"]); 
        Route::post("set_yearly_goal", [AdminController::class, "setYearlyGoal"]);
        Route::post("edit_yearly_goal", [AdminController::class, "editYearlyGoal"]);
        Route::post("delete_yearly_goal", [AdminController::class, "deleteYearlyGoal"]);
    });


});
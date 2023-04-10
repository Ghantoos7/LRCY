<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Post_type;

class PostController extends Controller
{


    function create_post(Request $request) {

        $request->validate([
            "user_id" => "required",
            "post_type" => "required|in:text,image,video",
            "post_content" => ($request->input("post_type") === "text") ? "required" : "nullable",
            "post_media" => ($request->input("post_type") !== "text") ? "required" : "nullable|image|max:2048"
        ]);
        
        $user_id = $request->input("user_id");
        $post_type = $request->input("post_type");
    
        $post = new Post;
        $post->user_id = $user_id;
        $post->post_type_id = Post_type::where('post_type_name', $post_type)->value('id');
        $post->comment_count = 0;
        $post->like_count = 0;
        $post->post_date = now();
    
        if ($post_type === "text") {
            $post->post_caption = $request->input("post_content");
        } else {
            $image = $request->file('post_media');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/post_media', $filename);
            $post->post_media = $filename;
        }
    
        $post->save();
    
        return response()->json([
            "status" => "success",
            "message" => "Post created successfully",
            "post_id" => $post->id
        ]);

    }
    
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Post_type;
use App\Models\volunteer_user;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{


    function create_post(Request $request) {

        // Validate the request inputs.
        $request->validate([
            'user_id' => 'required',
            'post_type' => 'required|in:text,image,video',
            'post_caption' => $request->input('post_type') === 'text' ? 'required' : 'nullable',
            'post_media' => $request->input('post_type') !== 'text' && !$request->has('post_caption') ? 'required|file|mimes:jpeg,png,jpg,gif,mp4,avi|max:2048' : 'nullable'
        ]);

        // Get the user ID from the request.
        $user_id = $request->input('user_id');

        // Find the user with the given ID.
        $user = volunteer_user::find($user_id);

        // If the user is not found, return an error response.
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }

        // Get the post type from the request.
        $post_type = $request->input('post_type');

        // Get the post type ID from the database.
        $post_type_id = Post_type::where('post_type_name', $post_type)->value('id');

        // If the post type ID is not found, return an error response.
        if (!$post_type_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid post type: ' . $post_type
            ]);
        }

        // Create a new post instance.
        $post = new Post([
            'user_id' => $user_id,
            'post_type_id' => $post_type_id,
            'comment_count' => 0,
            'like_count' => 0,
            'post_date' => now(),
            'post_caption' => $request->input('post_caption') ?? null
        ]);

        // If the post type is not text, upload the post media file.
        if ($post_type !== 'text') {
            $image = $request->file('post_media');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/post_media', $filename);
            $post->post_media = $filename;
        }

        // Save the post to the database.
        $post->save();

        // Return a success response with the post ID.
        return response()->json([
            'status' => 'success',
            'message' => 'Post created successfully',
            'post_id' => $post->id
        ]);

    }
    

    function edit_post(Request $request) {
        
        // Validate the request inputs
        $request->validate([
            'post_id' => 'required',
            'post_caption' => 'required',
        ]);
    
        // Get the post ID from the request
        $post_id = $request->input('post_id');
    
        // Find the post with the given ID
        $post = Post::find($post_id);
    
        // If the post is not found, return an error response
        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found'
            ]);
        }
    
        // Update the post caption
        $post->post_caption = $request->input('post_caption');
    
        // Save the post to the database
        if ($post->save()) {
            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Post updated successfully'
            ]);
        } else {
            // Return an error response if post could not be saved
            return response()->json([
                'status' => 'error',
                'message' => 'Post could not be updated'
            ]);
        }

    }
    
    
    
    
    
    
    
    
    
}

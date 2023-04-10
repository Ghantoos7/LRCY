<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Post_type;
use App\Models\Volunteer_user;
use App\Models\Like;
use App\Models\Comment;

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
    
    
    function delete_post(Request $request) {
    
        // Validate the request inputs
        $request->validate([
            'post_id' => 'required'
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
    
        // Delete the post
        if ($post->delete()) {
            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Post deleted successfully'
            ]);
        } else {
            // Return an error response if post could not be deleted
            return response()->json([
                'status' => 'error',
                'message' => 'Post could not be deleted'
            ]);
        }
    
    }
    

    function get_posts($user_id = null) {

        // If a user ID was provided, check if the user exists
        if ($user_id) {
            $user = volunteer_user::find($user_id);
            
            // If the user does not exist, return an error response
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'User not found']);
            }
        }
    
        // Retrieve the posts for the specified user, or all posts if no user ID was provided
        $posts = ($user_id) ? Post::where('user_id', $user_id)->get() : Post::all();
        
        // If no posts were found, return an error response
        if ($posts->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No posts found']);
        }
        
        // Remove unwanted fields from each post
        $posts->transform(function($post) {
            unset($post->created_at, $post->updated_at, $post->field1, $post->field2);
            return $post;
        });
        
        // Return a success response with the posts
        return response()->json(['status' => 'success', 'message' => 'Posts found', 'posts' => $posts]);

    }
    
    
    function like_post(Request $request) {
        
        // Validate the request inputs
        $request->validate(['post_id' => 'required', 'user_id' => 'required']);
    
        // Find the post and user
        $post = Post::find($request->input('post_id'));
        $user = volunteer_user::find($request->input('user_id'));
    
        // Return error response if post or user not found
        if (!$post) return response()->json(['status' => 'error', 'message' => 'Post not found']);
        if (!$user) return response()->json(['status' => 'error', 'message' => 'User not found']);
    
        // Check if the user has already liked the post
        if (Like::where('post_id', $post->id)->where('user_id', $user->id)->first()) {
            return response()->json(['status' => 'error', 'message' => 'You have already liked this post']);
        }
    
        // Create a new like instance with default value for like_date
        $like = new Like(['post_id' => $post->id, 'user_id' => $user->id, 'like_date' => now()]);
    
        // Save the like to the database
        $like_saved = $like->save();
    
        // Increment the post like count and return a success/error response
        $message = $like_saved ? ($post->increment('like_count') ? 'Post liked successfully' : 'Post like count could not be updated') : 'Post could not be liked';
        $status = $like_saved ? 'success' : 'error';
    
        return response()->json(['status' => $status, 'message' => $message]);
    
    }
    

    function unlike_post(Request $request) {
        
            // Validate the request inputs
            $request->validate(['post_id' => 'required', 'user_id' => 'required']);
        
            // Find the post and user
            $post = Post::find($request->input('post_id'));
            $user = volunteer_user::find($request->input('user_id'));
        
            // Return error response if post or user not found
            if (!$post) return response()->json(['status' => 'error', 'message' => 'Post not found']);
            if (!$user) return response()->json(['status' => 'error', 'message' => 'User not found']);
        
            // Check if the user has already liked the post
            if (!Like::where('post_id', $post->id)->where('user_id', $user->id)->first()) {
                return response()->json(['status' => 'error', 'message' => 'You have not liked this post']);
            }
        
            // Delete the like from the database
            $like_deleted = Like::where('post_id', $post->id)->where('user_id', $user->id)->delete();
        
            // Decrement the post like count and return a success/error response
            $message = $like_deleted ? ($post->decrement('like_count') ? 'Post unliked successfully' : 'Post like count could not be updated') : 'Post could not be unliked';
            $status = $like_deleted ? 'success' : 'error';
        
            return response()->json(['status' => $status, 'message' => $message]);
        
    }
    

    function comment_post(Request $request) {
            
        // Validate the request inputs
        $request->validate(['post_id' => 'required', 'user_id' => 'required', 'comment_content' => 'required']);
        
        // Find the post and user
        $post = Post::find($request->input('post_id'));
        $user = volunteer_user::find($request->input('user_id'));
        
        // Return error response if post or user not found
        if (!$post) return response()->json(['status' => 'error', 'message' => 'Post not found']);
        if (!$user) return response()->json(['status' => 'error', 'message' => 'User not found']);
        
        // Create a new comment instance with the current date
        $comment = new Comment([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'comment_content' => $request->input('comment_content'),
            'comment_date' => now(),
            'comment_like_count' => 0
        ]);
        
        // Save the comment to the database
        $comment_saved = $comment->save();
        
        // Increment the post comment count and return a success/error response
        $message = $comment_saved ? ($post->increment('comment_count') ? 'Comment posted successfully' : 'Post comment count could not be updated') : 'Comment could not be posted';
        $status = $comment_saved ? 'success' : 'error';
        
        return response()->json(['status' => $status, 'message' => $message]);
    }
    

}

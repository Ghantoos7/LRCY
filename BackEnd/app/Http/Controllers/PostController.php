<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Post_type;
use App\Models\Volunteer_user;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Comment_like;

class PostController extends Controller {


    function createPost(Request $request) {

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
    

    function editPost(Request $request) {

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
    
    
    function deletePost(Request $request) {
    
        // Validate the request inputs
        $request->validate([
            'post_id' => 'required',
            'user_id' => 'required'
        ]);
    
        // Get the post ID from the request
        $post_id = $request->input('post_id');

        // Get the user ID from the request
        $user_id = $request->input('user_id');
    
        // Find the post with the given ID
        $post = Post::find($post_id);
    
        // If the post is not found, return an error response
        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found'
            ]);
        }
    
        // If the user ID from the request does not match the user ID of the post, return an error response
        if ($post->user_id != $user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to delete this post'
            ]);
        }

        // Delete the post
        if ($post->delete()) {
            // Delete all likes for the post
            Like::where('post_id', $post_id)->delete();

            // Delete all replies on the comments for the post
            Reply::whereIn('comment_id', Comment::where('post_id', $post_id)->pluck('id'))->delete();

            // Delete all comment likes for the post
            Comment_like::whereIn('comment_id', Comment::where('post_id', $post_id)->pluck('id'))->delete();

            // Delete all comments for the post
            Comment::where('post_id', $post_id)->delete();

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

    function getPost($post_id){
        // Find the post with the given ID
        $post = Post::find($post_id);
    
        // If the post is not found, return an error response
        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found'
            ]);
        }

        // Unset field1 and field2 from the post data, and get the name of the user who posted the post
        unset($post->field1);
        unset($post->field2);
        $post->user_name = volunteer_user::where('id', $post->user_id)->value('first_name');

        // Return a success response with the post data
        return response()->json([
            'status' => 'success',
            'message' => 'Post found successfully',
            'post' => $post
        ]);
    }
    

    function getPosts($user_id = null) {
        // If a user ID was provided, check if the user exists
        if ($user_id) {
            $user = volunteer_user::find($user_id);
            
            // If the user does not exist, return an error response
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'User not found']);
            }
        }
        
        // Retrieve the posts for the specified user, or all posts if no user ID was provided (order by post date in descending order)
        $posts = Post::where('user_id', $user_id ?? '!=', null)->orderBy('post_date', 'desc')->get();
        
        // If no posts were found, return an error response
        if ($posts->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No posts found']);
        }
        
        // Remove unwanted fields from each post and retrieve name(concatenate first_name and last_name), profile picture, and username of the post owner based on the user ID
        $posts = $posts->transform(function($post) {
                 unset($post->created_at, $post->updated_at, $post->field1, $post->field2);
                 $user = volunteer_user::select('id','first_name', 'last_name', 'user_profile_pic', 'username', 'user_position', 'user_bio')->find($post->user_id);
                 // If no user was found for the post, return null
                 if (!$user) {
                     $post->user = null;
                 } else {
                     // make field name which is the first name and last name
                     $post->user = $user;
                     $post->user->name = $user->first_name . ' ' . $user->last_name;
                 }
                 return $post;
                });
        
        // Return a success response
        return response()->json(['status' => 'success', 'message' => 'Posts found', 'posts' => $posts]);
    }     
    
    
    function likePost(Request $request) {
        
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
    

    function unlikePost(Request $request) {
        
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
    

    function commentPost(Request $request) {
            
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
            'comment_like_count' => 0,
            'comment_reply_count' => 0
        ]);
        
        // Save the comment to the database
        $comment_saved = $comment->save();
        
        // Increment the post comment count and return a success/error response
        $message = $comment_saved ? ($post->increment('comment_count') ? 'Comment posted successfully' : 'Post comment count could not be updated') : 'Comment could not be posted';
        $status = $comment_saved ? 'success' : 'error';
        
        return response()->json(['status' => $status, 'message' => $message]);
        
    }
    

    function replyComment(Request $request) {
    
        // Validate the request inputs
        $request->validate(['comment_id' => 'required', 'user_id' => 'required', 'reply_content' => 'required']);
        
        // Find the comment and user
        $comment = Comment::find($request->input('comment_id'));
        $user = volunteer_user::find($request->input('user_id'));
        
        // Return error response if comment or user not found
        if (!$comment) return response()->json(['status' => 'error', 'message' => 'Comment not found']);
        if (!$user) return response()->json(['status' => 'error', 'message' => 'User not found']);
        
        // Create a new reply instance with the current date
        $reply = new Reply([
            'comment_id' => $comment->id,
            'user_id' => $user->id,
            'reply_content' => $request->input('reply_content'),
            'reply_date' => now()
        ]);
        
        // Save the reply to the database
        $reply_saved = $reply->save();
        
        // Increment the comment reply count and return a success/error response
        $message = $reply_saved ? ($comment->increment('comment_reply_count') ? 'Reply posted successfully' : 'Comment reply count could not be updated') : 'Reply could not be posted';
        $status = $reply_saved ? 'success' : 'error';
        
        return response()->json(['status' => $status, 'message' => $message]);
    
    }
    
    
    function likeComment(Request $request) {

        // Validate the request inputs
        $request->validate(['comment_id' => 'required', 'user_id' => 'required']);
    
        // Find the comment and user
        $comment = Comment::find($request->input('comment_id'));
        $user = volunteer_user::find($request->input('user_id'));
    
        // Return error response if comment or user not found
        if (!$comment) return response()->json(['status' => 'error', 'message' => 'Comment not found']);
        if (!$user) return response()->json(['status' => 'error', 'message' => 'User not found']);
    
        // Check if the user has already liked the comment
        if (Comment_like::where('comment_id', $comment->id)->where('user_id', $user->id)->first()) {
            return response()->json(['status' => 'error', 'message' => 'You have already liked this comment']);
        }
    
        // Create a new comment like instance with default value for like_date
        $like = new Comment_like(['comment_id' => $comment->id, 'user_id' => $user->id, 'like_date' => now()]);
    
        // Save the like to the database
        $like_saved = $like->save();
    
        // Increment the comment like count and return a success/error response
        $message = $like_saved ? ($comment->increment('comment_like_count') ? 'Comment liked successfully' : 'Comment like count could not be updated') : 'Comment could not be liked';
        $status = $like_saved ? 'success' : 'error';
    
        return response()->json(['status' => $status, 'message' => $message]);

    }
        

    function unlikeComment(Request $request) {

        // Validate the request inputs
        $request->validate(['comment_id' => 'required', 'user_id' => 'required']);
    
        // Find the comment and user
        $comment = Comment::find($request->input('comment_id'));
        $user = volunteer_user::find($request->input('user_id'));
    
        // Return error response if comment or user not found
        if (!$comment) return response()->json(['status' => 'error', 'message' => 'Comment not found']);
        if (!$user) return response()->json(['status' => 'error', 'message' => 'User not found']);
    
        // Check if the user has already liked the comment
        if (!Comment_like::where('comment_id', $comment->id)->where('user_id', $user->id)->first()) {
            return response()->json(['status' => 'error', 'message' => 'You have not liked this comment']);
        }
    
        // Delete the like from the database
        $like_deleted = Comment_like::where('comment_id', $comment->id)->where('user_id', $user->id)->delete();
    
        // Decrement the comment like count and return a success/error response
        $message = $like_deleted ? ($comment->decrement('comment_like_count') ? 'Comment unliked successfully' : 'Comment like count could not be updated') : 'Comment could not be unliked';
        $status = $like_deleted ? 'success' : 'error';
    
        return response()->json(['status' => $status, 'message' => $message]);
    
    }


    function deleteComment(Request $request) {

        // Validate the request inputs
        $request->validate(['comment_id' => 'required', 'user_id' => 'required']);
    
        // Find the comment and user
        $comment = Comment::find($request->input('comment_id'));
        $user = volunteer_user::find($request->input('user_id'));
    
        // Return error response if comment or user not found
        if (!$comment) return response()->json(['status' => 'error', 'message' => 'Comment not found']);
        if (!$user) return response()->json(['status' => 'error', 'message' => 'User not found']);
    
        // Check if the user is the comment owner
        if ($comment->user_id != $user->id) {
            return response()->json(['status' => 'error', 'message' => 'You are not the owner of this comment']);
        }
    
        // Get the post associated with the comment using the post_id in the comment
        $post = Post::find($comment->post_id);
    
        // Delete the comment from the database
        $comment_deleted = $comment->delete();

        // Delete all the likes associated with the comment
        Comment_like::where('comment_id', $comment->id)->delete();

        // Delete all the replies associated with the comment
        Reply::where('comment_id', $comment->id)->delete();
    
        // Decrement the post comment count and return a success/error response
        $message = $comment_deleted ? ($post->decrement('comment_count') ? 'Comment deleted successfully' : 'Post comment count could not be updated') : 'Comment could not be deleted';
        $status = $comment_deleted ? 'success' : 'error';
    
        return response()->json(['status' => $status, 'message' => $message]);
    
    }
    

    function deleteReply(Request $request) {

        // Validate the request inputs
        $request->validate(['reply_id' => 'required', 'user_id' => 'required']);
    
        // Find the reply and user
        $reply = Reply::find($request->input('reply_id'));
        $user = volunteer_user::find($request->input('user_id'));
    
        // Return error response if reply or user not found
        if (!$reply) return response()->json(['status' => 'error', 'message' => 'Reply not found']);
        if (!$user) return response()->json(['status' => 'error', 'message' => 'User not found']);
    
        // Check if the user is the reply owner
        if ($reply->user_id != $user->id) {
            return response()->json(['status' => 'error', 'message' => 'You are not the owner of this reply']);
        }
    
        // Get the comment associated with the reply using the comment_id in the reply
        $comment = Comment::find($reply->comment_id);
    
        // Delete the reply from the database
        $reply_deleted = $reply->delete();
    
        // Decrement the comment reply count and return a success/error response
        $message = $reply_deleted ? ($comment->decrement('comment_reply_count') ? 'Reply deleted successfully' : 'Comment reply count could not be updated') : 'Reply could not be deleted';
        $status = $reply_deleted ? 'success' : 'error';
    
        return response()->json(['status' => $status, 'message' => $message]);

    }


    function editComment(Request $request) {

        // Validate the request inputs
        $request->validate(['comment_id' => 'required', 'user_id' => 'required', 'comment_content' => 'required']);
    
        // Find the comment and user
        $comment = Comment::find($request->input('comment_id'));
        $user = volunteer_user::find($request->input('user_id'));
    
        // Return error response if comment or user not found
        if (!$comment) return response()->json(['status' => 'error', 'message' => 'Comment not found']);
        if (!$user) return response()->json(['status' => 'error', 'message' => 'User not found']);
    
        // Check if the user is the comment owner
        if ($comment->user_id != $user->id) {
            return response()->json(['status' => 'error', 'message' => 'You are not the owner of this comment']);
        }
    
        // Update the comment and return a success/error response
        $comment_updated = $comment->update(['comment_content' => $request->input('comment_content')]);
        $message = $comment_updated ? 'Comment updated successfully' : 'Comment could not be updated';
        $status = $comment_updated ? 'success' : 'error';
    
        return response()->json(['status' => $status, 'message' => $message]);
    
    }


    function editReply(Request $request) {
        
        // Validate the request inputs
        $request->validate(['reply_id' => 'required', 'user_id' => 'required', 'reply_content' => 'required']);
    
        // Find the reply and user
        $reply = Reply::find($request->input('reply_id'));
        $user = volunteer_user::find($request->input('user_id'));
    
        // Return error response if reply or user not found
        if (!$reply) return response()->json(['status' => 'error', 'message' => 'Reply not found']);
        if (!$user) return response()->json(['status' => 'error', 'message' => 'User not found']);
    
        // Check if the user is the reply owner
        if ($reply->user_id != $user->id) {
            return response()->json(['status' => 'error', 'message' => 'You are not the owner of this reply']);
        }
    
        // Update the reply and return a success/error response
        $reply_updated = $reply->update(['reply_content' => $request->input('reply_content')]);
        $message = $reply_updated ? 'Reply updated successfully' : 'Reply could not be updated';
        $status = $reply_updated ? 'success' : 'error';
    
        return response()->json(['status' => $status, 'message' => $message]);

    }


    function getComments($post_id, $sort_by = 'date') {

        // Find the post
        $post = Post::find($post_id);
        
        // Return error response if post not found
        if (!$post) {
            return response()->json(['status' => 'error', 'message' => 'Post not found']);
        }
        
        // Get the comments associated with the post
        $comments = Comment::where('post_id', $post_id);

        // Sort by popularity
        if ($sort_by === 'popularity') {
            $comments->orderByRaw('(comment_like_count + comment_reply_count) DESC')->orderBy('created_at', 'desc');
        }
        // Sort by date
        else {
            $comments->orderBy('created_at', 'desc');
        }

        // Get the comments as a collection of results
        $comments = $comments->get();

        // Remove the fields we don't want to return and get the user who made the comment
        $comments->transform(function ($comment) {
            unset($comment->field1, $comment->field2, $comment->created_at, $comment->updated_at);
            $comment->user = volunteer_user::find($comment->user_id);
            unset($comment->user_id);
            return $comment;
        });

        // Return the comments or an error response if no comments found
        return $comments->isEmpty() ? response()->json(['status' => 'error', 'message' => 'No comments found for this post']) : response()->json(['status' => 'success', 'comments' => $comments]);

    }    


    function getReplies($comment_id) {

        // Find the comment
        $comment = Comment::find($comment_id);
    
        // Return error response if comment not found
        if (!$comment) return response()->json(['status' => 'error', 'message' => 'Comment not found']);
    
        // Get the replies associated with the comment and convert to a collection
        $replies = Reply::where('comment_id', $comment_id)->orderBy('created_at', 'desc')->get();

        // Transform the collection to remove unwanted fields and get user info
        $replies->transform(function ($reply) {
            unset($reply->field1, $reply->field2, $reply->created_at, $reply->updated_at);
            $reply->user = volunteer_user::find($reply->user_id);
            return $reply;
        });

        // Return the replies or an error response if no replies found
        return $replies->isEmpty() ? response()->json(['status' => 'error', 'message' => 'No replies found for this comment']) : response()->json(['status' => 'success', 'replies' => $replies]);

    
    }    


    function getPostLikes($post_id) {

        // Find the post
        $post = Post::find($post_id);
    
        // Return error response if post not found
        if (!$post) return response()->json(['status' => 'error', 'message' => 'Post not found']);
    
        // Get the likes associated with the post
        $likes = Like::where('post_id', $post_id)->orderBy('created_at', 'desc')->paginate(10);
    
        // Remove the fields we don't want to return
        foreach ($likes as $like) {
            unset($like->field1, $like->field2, $like->created_at, $like->updated_at, $like->like_date);
        }
    
        // Return the likes and the total like count or an error response if no likes found
        return (count($likes) === 0) ? response()->json(['status' => 'error', 'message' => 'No likes found for this post']) : response()->json(['status' => 'success', 'likes' => $likes, 'total_likes' => $likes->total()]);
    
    }    


    function getCommentLikes($comment_id) {

        // Find the comment
        $comment = Comment::find($comment_id);
        
        // Return error response if comment not found
        if (!$comment) return response()->json(['status' => 'error', 'message' => 'Comment not found']);
        
        // Get the likes associated with the comment
        $likes = Comment_like::where('comment_id', $comment_id)->orderBy('created_at', 'desc')->paginate(10);
        
        // Remove the fields we don't want to return
        foreach ($likes as $like) {
            unset($like->field1, $like->field2, $like->created_at, $like->updated_at, $like->like_date);
        }
        
        // Return the likes and the total like count or an error response if no likes found
        return (count($likes) === 0) ? response()->json(['status' => 'error', 'message' => 'No likes found for this comment']) : response()->json(['status' => 'success', 'likes' => $likes, 'total_likes' => $likes->total()]);

    }

    
}

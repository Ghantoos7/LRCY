<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Post;
use App\Models\Post_type;
use App\Models\Volunteer_user;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Comment_like;

class PostControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    use WithFaker;

    public function testCreatePostApi()
    {
        // Create a user for testing
        $user = Volunteer_user::factory()->create();

        // Test creating a text post
        $textPostData = [
            'user_id' => $user->id,
            'post_type' => 'text',
            'post_caption' => 'This is a text post',
        ];
        $responseText = $this->postJson('/api/v0.1/post/create_post', $textPostData);
        $responseText->assertStatus(200);

        // Test creating an image post
        $imagePath = __DIR__ . '/test-image.jpg';
        $image = new UploadedFile($imagePath, 'test-image.jpg', 'image/jpeg', null, true);
        $imagePostData = [
            'user_id' => $user->id,
            'post_type' => 'image',
            'post_caption' => 'This is an image post',
            'post_media' => $image,
        ];
        $responseImage = $this->postJson('/api/v0.1/post/create_post', $imagePostData);
        $responseImage->assertStatus(200);
    }

    function testEditPostApi()
    {
        // Create a new post
        $post = Post::factory()->create();

        // Edit the post caption
        $newCaption = 'New post caption';
        $postData = [
            'post_id' => $post->id,
            'post_caption' => $newCaption,
        ];
        $response = $this->postJson('/api/v0.1/post/edit_post', $postData);

        // Check if the response is successful
        $response->assertStatus(200);

        // Check if the post caption is updated in the database
        $updatedPost = Post::find($post->id);
        $this->assertEquals($newCaption, $updatedPost->post_caption);
    }

    function testDeletePostApi()
    {
        // Create a post
        $user = Volunteer_user::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        // Test deleting a post with a different user ID
        $response = $this->postJson('/api/v0.1/post/delete_post', [
            'post_id' => $post->id,
            'user_id' => $user->id + 1,
        ]);
        $response->assertStatus(200)->assertJson([
            'status' => 'error',
            'message' => 'You are not authorized to delete this post',
        ]);

        // Test deleting a post
        $response = $this->postJson('/api/v0.1/post/delete_post', [
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'message' => 'Post deleted successfully',
        ]);

        // Test deleting a post that doesn't exist
        $response = $this->postJson('/api/v0.1/post/delete_post', [
            'post_id' => 999,
            'user_id' => $user->id,
        ]);
        $response->assertStatus(200)->assertJson([
            'status' => 'error',
            'message' => 'Post not found',
        ]);
    }

    function testGetPostApi()
    {
        // Create a user
        $user = Volunteer_user::factory()->create();

        // Create a post by the user
        $post = Post::factory()->create(['user_id' => $user->id]);

        // Test getting the post
        $response = $this->getJson('/api/v0.1/post/get_post/' . $post->id);
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'message' => 'Post found successfully',
            'post' => [
                'id' => $post->id,
                'user_id' => $user->id,
                'post_caption' => $post->post_caption,
                'user_name' => $user->first_name,
                'comment_count' => $post->comment_count,
                'like_count' => $post->like_count,
                'post_date' => $post->post_date,
            ],
        ]);
    }

    function testGetPostsApi()
    {
        // Test getting all posts
        $responseAll = $this->get('/api/v0.1/post/get_posts');
        $responseAll->assertStatus(200);

        $user = Volunteer_user::factory()->create();

        // Test getting posts for a specific user
        $responseUser = $this->get('/api/v0.1/post/get_posts/' . $user->id);
        $responseUser->assertStatus(200);
    }

    function testLikePostApi()
    {
        // Create a user
        $user = Volunteer_user::factory()->create();

        // Create a post
        $post = Post::factory()->create(['user_id' => $user->id]);

        // Send a POST request to like the post
        $response = $this->postJson('/api/v0.1/post/like_post', [
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);

        // Assert that the response status is 200
        $response->assertStatus(200);

        // Assert that the response message is 'Post liked successfully'
        $response->assertJson([
            'status' => 'success',
            'message' => 'Post liked successfully',
        ]);

        // Assert that the post like count has been incremented
        $this->assertEquals(1, $post->fresh()->like_count);

        // Send another POST request to like the same post
        $response = $this->postJson('/api/v0.1/post/like_post', [
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);

        // Assert that the response status is 200
        $response->assertStatus(200);

        // Assert that the response message is 'You have already liked this post'
        $response->assertJson([
            'status' => 'error',
            'message' => 'You have already liked this post',
        ]);

        // Assert that the post like count has not been incremented
        $this->assertEquals(1, $post->fresh()->like_count);
    }

    function testUnlikePostApi()
    {
        // Create a user
        $user = Volunteer_user::factory()->create();

        // Create a post
        $post = Post::factory()->create(['user_id' => $user->id]);

        // Like the post
        $like = Like::factory()->create(['post_id' => $post->id, 'user_id' => $user->id]);

        // Send unlike post request
        $response = $this->postJson('/api/v0.1/post/unlike_post', [
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);

        // Check response
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'message' => 'Post unliked successfully',
        ]);

        // Check if post like count has been decremented
        $this->assertEquals(-1, $post->fresh()->like_count);
    }

    function testCommentPostApi()
    {
        // Create a user
        $user = Volunteer_user::factory()->create();

        // Create a post
        $post = Post::factory()->create(['user_id' => $user->id]);

        // Send a comment request with valid inputs
        $response = $this->post('/api/v0.1/post/comment_post', [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'comment_content' => 'This is a test comment',
        ]);

        // Assert that the response has a success status code
        $response->assertStatus(200);

        // Assert that the post's comment count has been incremented
        $this->assertEquals(1, $post->fresh()->comment_count);

        // Send a comment request with an invalid post ID
        $response = $this->post('/api/v0.1/post/comment_post', [
            'post_id' => 'invalid_postdd_id',
            'user_id' => $user->id + 31,
            'comment_content' => 'This is a test comment',
        ]);

        // Assert that the response has an error status code
        $response->assertJson(['status' => 'error']);

        // Send a comment request with an invalid user ID
        $response = $this->post('/api/v0.1/post/comment_post', [
            'post_id' => $post->id,
            'user_id' => 'invalid_user_id',
            'comment_content' => 'This is a test comment',
        ]);

        // Assert that the response has an error status code
        $response->assertJson(['status' => 'error']);
    }

    function testReplyCommentApi()
    {
        // Create a user
        $user = Volunteer_user::factory()->create();

        // Create a post
        $post = Post::factory()->create(['user_id' => $user->id]);

        // Create a comment on the post by the user
        $comment = Comment::factory()->create([
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);

        // Create a reply content
        $reply_content = 'Test reply content';

        // Call the API to reply to the comment
        $response = $this->post('/api/v0.1/post/reply_comment', [
            'comment_id' => $comment->id,
            'user_id' => $user->id,
            'reply_content' => $reply_content,
        ]);

        // Assert that the response has a success status code
        $response->assertStatus(200);

        // Assert that the response message indicates success
        $response->assertJson(['status' => 'success', 'message' => 'Reply posted successfully']);

        // Assert that the reply was saved to the database
        $this->assertDatabaseHas('replies', [
            'comment_id' => $comment->id,
            'user_id' => $user->id,
            'reply_content' => $reply_content,
        ]);

        // Assert that the comment's reply count was incremented
        $this->assertEquals(1, $comment->fresh()->comment_reply_count);
    }

    function testLikeCommentApi()
    {
        // Create a user and a comment for testing
        $user = volunteer_user::factory()->create();
        $comment = Comment::factory()->create();

        // Send a POST request to like the comment
        $response = $this->postJson('/api/v0.1/post/like_comment', [
            'comment_id' => $comment->id,
            'user_id' => $user->id,
        ]);

        // Assert that the response has a 200 status code
        $response->assertStatus(200);

        // Assert that the response has a 'success' status and the expected message
        $response->assertJson([
            'status' => 'success',
            'message' => 'Comment liked successfully',
        ]);

        // Assert that the comment like count has been incremented
        $this->assertEquals(0, $comment->comment_like_count);

        // Send another POST request to like the same comment with the same user
        $response = $this->postJson('/api/v0.1/post/like_comment', [
            'comment_id' => $comment->id,
            'user_id' => $user->id,
        ]);

        // Assert that the response has a 'error' status and the expected message
        $response->assertJson([
            'status' => 'error',
            'message' => 'You have already liked this comment',
        ]);

        // Assert that the comment like count has not changed
        $this->assertEquals(0, $comment->comment_like_count);

        // Send a POST request to like a non-existent comment
        $response = $this->postJson('/api/v0.1/post/like_comment', [
            'comment_id' => 999,
            'user_id' => $user->id,
        ]);

        // Assert that the response has a 'error' status and the expected message
        $response->assertJson([
            'status' => 'error',
            'message' => 'Comment not found',
        ]);

        // Send a POST request to like a comment with a non-existent user
        $response = $this->postJson('/api/v0.1/post/like_comment', [
            'comment_id' => $comment->id,
            'user_id' => 999,
        ]);

        // Assert that the response has a 'error' status and the expected message
        $response->assertJson([
            'status' => 'error',
            'message' => 'User not found',
        ]);
    }

    function testUnlikeCommentApi()
    {
        // Create a user and a comment for testing
        $user = volunteer_user::factory()->create();

        $comment = Comment::factory()->create();
        // Create a test post
        $post = Post::factory()->create(['user_id' => $user->id]);

        // Create a test comment like
        $comment_like = Comment_like::factory()->create([
            'comment_id' => $comment->id,
            'user_id' => $user->id,
        ]);

        // Send a request to unlike the comment
        $response = $this->post('/api/v0.1/post/unlike_comment', [
            'comment_id' => $comment->id,
            'user_id' => $user->id,
        ]);

        // Check if the response has a success status code
        $response->assertStatus(200);

        // Check if the response message indicates that the comment was unliked successfully
        $response->assertJson([
            'status' => 'success',
            'message' => 'Comment unliked successfully',
        ]);

        // Check if the comment like was deleted from the database
        $this->assertDatabaseMissing('comment_likes', [
            'comment_id' => $comment->id,
            'user_id' => $user->id,
        ]);

        // Check if the comment like count was decremented
        $comment = Comment::find($comment->id);
        $this->assertEquals(-1, $comment->comment_like_count);

        // Send another request to unlike the comment (should fail since the user has already unliked the comment)
        $response = $this->post('/api/v0.1/post/unlike_comment', [
            'comment_id' => $comment->id,
            'user_id' => $user->id,
        ]);
    }

    function testDeleteCommentApi()
    {
        // Create a volunteer user
        $user = Volunteer_user::factory()->create();

        // Create a post by the volunteer user
        $post = Post::factory()->create(['user_id' => $user->id]);

        // Create a comment on the post by the volunteer user
        $comment = Comment::factory()->create(['post_id' => $post->id, 'user_id' => $user->id]);

        // Send a delete comment request for the comment by the volunteer user
        $response = $this->actingAs($user)->postJson('/api/v0.1/post/delete_comment', ['comment_id' => $comment->id, 'user_id' => $user->id]);

        // Assert that the response status is 200 and the message is correct
        $response->assertStatus(200)->assertExactJson(['status' => 'success', 'message' => 'Comment deleted successfully']);

        // Assert that the comment and associated likes and replies are deleted
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
        $this->assertDatabaseMissing('comment_likes', ['comment_id' => $comment->id]);
        $this->assertDatabaseMissing('replies', ['comment_id' => $comment->id]);

        // Assert that the post comment count is decremented
        $this->assertDatabaseHas('posts', ['id' => $post->id, 'comment_count' => -1]);

        // Send a delete comment request for a non-existent comment by the volunteer user
        $response = $this->actingAs($user)->postJson('/api/v0.1/post/delete_comment', ['comment_id' => 999, 'user_id' => $user->id]);

        // Assert that the response status is 200 and the message is correct
        $response->assertStatus(200)->assertExactJson(['status' => 'error', 'message' => 'Comment not found']);

        // Create another volunteer user and send a delete comment request for the comment by the other user
        $otherUser = Volunteer_user::factory()->create();
        $response = $this->actingAs($otherUser)->postJson('/api/v0.1/post/delete_comment', ['comment_id' => $comment->id, 'user_id' => $otherUser->id + 1]);

        // Assert that the response status is 200 and the message is correct
        $response->assertStatus(200)->assertExactJson(['status' => 'error', 'message' => 'Comment not found']);
    }

    function testDeleteReplyApi()
    {
        // Create a volunteer user
        $user = Volunteer_user::factory()->create();

        // Create a post by the volunteer user
        $post = Post::factory()->create(['user_id' => $user->id]);

        // Create a comment on the post by the volunteer user
        $comment = Comment::factory()->create(['post_id' => $post->id, 'user_id' => $user->id]);

        // Create a new reply on the comment
        $reply = reply::factory()->create(['comment_id' => $comment->id, 'user_id' => $user->id]);

        // Set up the request payload
        $payload = ['reply_id' => $reply->id, 'user_id' => $user->id];

        // Send the request to delete the reply
        $response = $this->json('POST', '/api/v0.1/post/delete_reply', $payload);

        // Check that the reply was deleted
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);

        // Check that the comment reply count was decremented
        $this->assertEquals(0, $comment->comment_reply_count);

        // Check that the response has the correct status and message
        $response->assertJson(['status' => 'success', 'message' => 'Reply deleted successfully']);
    }

    function testEditCommentApi()
    {
        // Create a user
        $user = Volunteer_user::factory()->create();

        // Create a comment by the user
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
        ]);

        // Test editing the comment by the owner user
        $response = $this->postJson('/api/v0.1/post/edit_comment', [
            'comment_id' => $comment->id,
            'user_id' => $user->id,
            'comment_content' => 'Updated comment content',
        ]);
        $response->assertJson([
            'status' => 'success',
            'message' => 'Comment updated successfully',
        ]);
        $response->assertStatus(200);

        // Create another user
        $otherUser = Volunteer_user::factory()->create();

        // Test editing the comment by a non-owner user
        $response = $this->postJson('/api/v0.1/post/edit_comment', [
            'comment_id' => $comment->id,
            'user_id' => $otherUser->id,
            'comment_content' => 'Updated comment content',
        ]);
        $response->assertJson([
            'status' => 'error',
            'message' => 'You are not the owner of this comment',
        ]);
        $response->assertStatus(200);

        // Test editing a non-existing comment
        $response = $this->postJson('/api/v0.1/post/edit_comment', [
            'comment_id' => '999',
            'user_id' => $user->id,
            'comment_content' => 'Updated comment content',
        ]);
        $response->assertJson([
            'status' => 'error',
            'message' => 'Comment not found',
        ]);
        $response->assertStatus(200);

        // Test editing a comment by a non-existing user
        $response = $this->postJson('/api/v0.1/post/edit_comment', [
            'comment_id' => $comment->id,
            'user_id' => '999',
            'comment_content' => 'Updated comment content',
        ]);
        $response->assertJson([
            'status' => 'error',
            'message' => 'User not found',
        ]);
        $response->assertStatus(200);

        // Test editing a comment without providing the comment_id input
        $response = $this->postJson('/api/v0.1/post/edit_comment', [
            'user_id' => $user->id,
            'comment_content' => 'Updated comment content',
        ]);
        $response->assertJsonValidationErrors('comment_id');
        $response->assertStatus(422);

        // Test editing a comment without providing the user_id input
        $response = $this->postJson('/api/v0.1/post/edit_comment', [
            'comment_id' => $comment->id,
            'comment_content' => 'Updated comment content',
        ]);
        $response->assertJsonValidationErrors('user_id');
        $response->assertStatus(422);

        // Test editing a comment without providing the comment_content input
        $response = $this->postJson('/api/v0.1/post/edit_comment', [
            'comment_id' => $comment->id,
            'user_id' => $user->id,
        ]);
        $response->assertJsonValidationErrors('comment_content');
        $response->assertStatus(422);
    }

    function testEditReplyApi()
    {
        // Create a user
        $user = Volunteer_user::factory()->create();

        // Create a comment
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
        ]);

        // Create a reply
        $reply = Reply::factory()->create([
            'comment_id' => $comment->id,
            'user_id' => $user->id,
        ]);

        // Test updating the reply
        $response = $this->postJson('/api/v0.1/post/edit_reply', [
            'reply_id' => $reply->id,
            'user_id' => $user->id,
            'reply_content' => 'Updated reply content',
        ]);
        $response->assertJson([
            'status' => 'success',
            'message' => 'Reply updated successfully',
        ]);
        $response->assertStatus(200);

        // Test updating the reply with invalid reply_id
        $response = $this->postJson('/api/v0.1/post/edit_reply', [
            'reply_id' => 999,
            'user_id' => $user->id,
            'reply_content' => 'Updated reply content',
        ]);
        $response->assertJson([
            'status' => 'error',
            'message' => 'Reply not found',
        ]);
        $response->assertStatus(200);

        // Test updating the reply with invalid user_id
        $response = $this->postJson('/api/v0.1/post/edit_reply', [
            'reply_id' => $reply->id,
            'user_id' => 999,
            'reply_content' => 'Updated reply content',
        ]);
        $response->assertJson([
            'status' => 'error',
            'message' => 'User not found',
        ]);
        $response->assertStatus(200);

        // Test updating the reply by a user who is not the owner
        $otherUser = Volunteer_user::factory()->create();
        $response = $this->postJson('/api/v0.1/post/edit_reply', [
            'reply_id' => $reply->id,
            'user_id' => $otherUser->id,
            'reply_content' => 'Updated reply content',
        ]);
        $response->assertJson([
            'status' => 'error',
            'message' => 'You are not the owner of this reply',
        ]);
        $response->assertStatus(200);
    }

    function testGetCommentsApi()
    {
        // Create a post
        $post = Post::factory()->create();

        // Create comments associated with the post
        $comment1 = Comment::factory()->create(['post_id' => $post->id]);
        $comment2 = Comment::factory()->create(['post_id' => $post->id]);

        // Test getComments API with valid post_id
        $response = $this->get("/api/v0.1/post/get_comments/{$post->id}");
        $response->assertJson([
            'status' => 'success',
        ]);
        $response->assertStatus(200);

        // Test getComments API with invalid post_id
        $response = $this->get('/api/v0.1/post/get_comments/999');
        $response->assertJson([
            'status' => 'error',
            'message' => 'Post not found',
        ]);
        $response->assertStatus(200);

        // Delete the comments and the post
        $comment1->delete();
        $comment2->delete();
        $post->delete();
    }

    function testGetRepliesApi()
    {
        // Create a comment and a reply for that comment
        $comment = Comment::factory()->create();
        $reply = Reply::factory()->create(['comment_id' => $comment->id]);

        // Test the getReplies API with valid comment ID
        $response = $this->get("/api/v0.1/post/get_replies/{$comment->id}");
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
        ]);

        // Test the getReplies API with invalid comment ID
        $response = $this->get('/api/v0.1/post/get_replies/999');
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'error',
            'message' => 'Comment not found',
        ]);

        // Test the getReplies API with comment ID with no replies
        $commentWithoutReplies = Comment::factory()->create();
        $response = $this->get("/api/v0.1/post/get_replies/{$commentWithoutReplies->id}");
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'error',
            'message' => 'No replies found for this comment',
        ]);
    }

    function testGetPostLikesApi()
    {
        // Create a post
        $post = Post::factory()->create();

        // Create 15 likes for the post
        $likes = Like::factory()
            ->count(15)
            ->create(['post_id' => $post->id]);

        // Test getting post likes with valid post ID
        $response = $this->get("/api/v0.1/post/get_post_likes/{$post->id}");
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
        ]);

        // Test getting post likes with invalid post ID
        $response = $this->get('/api/v0.1/post/get_post_likes/1000');
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'error',
            'message' => 'Post not found',
        ]);
    }
}

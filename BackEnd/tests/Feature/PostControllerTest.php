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
}

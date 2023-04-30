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

}

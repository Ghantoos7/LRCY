<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Volunteer_user;
use App\Models\Login_attempt;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    use WithFaker;
    
    public function test_signup_api()
{
    // Test Organization ID not found
    $response = $this->postJson('/api/v0.1/auth/signup', [
        'organization_id' => 999,
    ]);
    $response->assertStatus(200)
             ->assertJson([
                 'status' => 'Organization ID not found',
             ]);

    // Create a volunteer user who is not registered
    $notRegisteredUser = Volunteer_user::factory()->create([
        'organization_id' => 1000,
        'is_registered' => false,
    ]);

    // Test Organization ID found, user not registered
    $response = $this->postJson('/api/v0.1/auth/signup', [
        'organization_id' => $notRegisteredUser->organization_id,
    ]);
    $response->assertStatus(200)
             ->assertJson([
                 'status' => 'Organization ID found, user not registered',
             ]);

    // Update the volunteer user to be registered
    $notRegisteredUser->is_registered = true;
    $notRegisteredUser->save();

    // Test Organization ID found, user already registered
    $response = $this->postJson('/api/v0.1/auth/signup', [
        'organization_id' => $notRegisteredUser->organization_id,
    ]);
    $response->assertStatus(200)
             ->assertJson([
                 'status' => 'Organization ID found, user already registered',
             ]);
    }

    public function test_register_api()
    {
        // Test case: Missing required fields
        $response = $this->postJson('/api/v0.1/auth/register');
        $response->assertJson(['status' => 'Invalid input']);
        $response->assertStatus(200);

        // Test case: Invalid password
        $response = $this->postJson('/api/v0.1/auth/register', [
            'organization_id' => '1',
            'username' => 'testuser',
            'password' => 'short',
            'confirm_password' => 'short'
        ]);
        $response->assertJson(['status' => 'Invalid password']);
        $response->assertStatus(200);

        // Create an unregistered VolunteerUser
        Volunteer_user::factory()->create([
            'organization_id' => '1',
            'is_registered' => 0,
        ]);

        // Test case: Successful registration
        $response = $this->postJson('/api/v0.1/auth/register', [
            'organization_id' => '1',
            'username' => 'testuser',
            'password' => 'ValidPassword123',
            'confirm_password' => 'ValidPassword123'
        ]);
        $response->assertJson(['status' => 'Organization ID found, user registered successfully']);
        $response->assertStatus(200);

        // Test case: User already registered
        $response = $this->postJson('/api/v0.1/auth/register', [
            'organization_id' => '1',
            'username' => 'testuser',
            'password' => 'ValidPassword123',
            'confirm_password' => 'ValidPassword123'
        ]);
        $response->assertJson(['status' => 'Organization ID found, user already registered']);
        $response->assertStatus(200);
    }

}
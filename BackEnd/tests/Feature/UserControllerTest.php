<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Tests\TestCase;
use App\Models\volunteer_user;
use App\Models\recover_request;
use App\Models\take;
use App\Models\training;
use App\Models\login_attempt;
use App\Models\post;
use App\Models\comment;
use App\Models\is_responsible;
use App\Models\event;
use App\Models\branch;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    use WithFaker;

    function testSignupApi()
    {
        // Test Organization ID not found
        $response = $this->postJson('/api/v0.1/auth/signup', [
            'organization_id' => 999,
        ]);
        $response->assertStatus(200)->assertJson([
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
        $response->assertStatus(200)->assertJson([
            'status' => 'Organization ID found, user not registered',
        ]);

        // Update the volunteer user to be registered
        $notRegisteredUser->is_registered = true;
        $notRegisteredUser->save();

        // Test Organization ID found, user already registered
        $response = $this->postJson('/api/v0.1/auth/signup', [
            'organization_id' => $notRegisteredUser->organization_id,
        ]);
        $response->assertStatus(200)->assertJson([
            'status' => 'Organization ID found, user already registered',
        ]);
    }

    function testRegisterApi()
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
            'confirm_password' => 'short',
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
            'confirm_password' => 'ValidPassword123',
        ]);
        $response->assertJson(['status' => 'Organization ID found, user registered successfully']);
        $response->assertStatus(200);

        // Test case: User already registered
        $response = $this->postJson('/api/v0.1/auth/register', [
            'organization_id' => '1',
            'username' => 'testuser',
            'password' => 'ValidPassword123',
            'confirm_password' => 'ValidPassword123',
        ]);
        $response->assertJson(['status' => 'Organization ID found, user already registered']);
        $response->assertStatus(200);
    }

    function test_login_api()
    {
        // Test case: Invalid credentials (user does not exist)
        $response = $this->postJson('/api/v0.1/auth/login', [
            'organization_id' => '999',
            'password' => 'ValidPassword123',
        ]);
        $response->assertJson(['status' => 'Invalid credentials']);
        $response->assertStatus(200);

        // Create a registered and active VolunteerUser
        $activeUser = Volunteer_user::factory()->create([
            'organization_id' => '1',
            'is_registered' => 1,
            'is_active' => 1,
            'password' => Hash::make('ValidPassword123'),
        ]);

        // Test case: Successful login
        $response = $this->postJson('/api/v0.1/auth/login', [
            'organization_id' => '1',
            'password' => 'ValidPassword123',
        ]);
        $response->assertJson(['status' => 'Login successful']);
        $response->assertStatus(200);

        // Test case: Invalid credentials (incorrect password)
        $response = $this->postJson('/api/v0.1/auth/login', [
            'organization_id' => '1',
            'password' => 'WrongPassword123',
        ]);
        $response->assertJson(['status' => 'Invalid credentials']);
        $response->assertStatus(200);

        // Test case: Too many failed login attempts
        for ($i = 0; $i < 5; $i++) {
            $this->addFailedLoginAttempt(1);
        }
        $response = $this->postJson('/api/v0.1/auth/login', [
            'organization_id' => '1',
            'password' => 'WrongPassword123',
        ]);
        $response->assertJson(['status' => 'Too many failed login attempts']);
        $response->assertStatus(200);
    }

    private function addFailedLoginAttempt($organization_id)
    {
        Login_attempt::create([
            'organization_id' => $organization_id,
            'login_attempt_date' => Carbon::now(),
            'login_attempt_time' => Carbon::now(),
        ]);
    }

    function testRecoverRequestApi()
    {
        // Test case: Organization ID not found
        $response = $this->postJson('/api/v0.1/auth/recover_request', [
            'organization_id' => '999',
        ]);
        $response->assertJson(['status' => 'Organization ID not found']);
        $response->assertStatus(200);

        // Create a registered VolunteerUser
        $registeredUser = Volunteer_user::factory()->create([
            'organization_id' => '1',
            'is_registered' => 1,
        ]);

        // Test case: Recovery request sent successfully
        $response = $this->postJson('/api/v0.1/auth/recover_request', [
            'organization_id' => '1',
        ]);
        $response->assertJson(['status' => 'Recovery request sent successfully!']);
        $response->assertStatus(200);

        // Create a recovery request for the registered user
        Recover_request::create([
            'user_id' => $registeredUser->id,
            'request_status' => false,
            'request_date' => date('Y-m-d'),
        ]);

        // Test case: User has already submitted a request
        $response = $this->postJson('/api/v0.1/auth/recover_request', [
            'organization_id' => '1',
        ]);
        $response->assertJson(['status' => 'User has already submitted a request.']);
        $response->assertStatus(200);
    }

    function testChangePasswordApi()
    {
        // Test case: Organization ID not found
        $response = $this->postJson('/api/v0.1/auth/change_password', [
            'organization_id' => '999',
            'password' => 'NewSecurePassword123',
            'confirm_password' => 'NewSecurePassword123',
        ]);
        $response->assertJson(['status' => 'error', 'message' => 'User does not exist']);
        $response->assertStatus(200);

        // Create a registered VolunteerUser
        $registeredUser = Volunteer_user::factory()->create([
            'organization_id' => '1',
            'is_registered' => 1,
        ]);

        // Test case: User has not submitted a password recovery request
        $response = $this->postJson('/api/v0.1/auth/change_password', [
            'organization_id' => '1',
            'password' => 'NewSecurePassword123',
            'confirm_password' => 'NewSecurePassword123',
        ]);
        $response->assertJson(['status' => 'error', 'message' => 'User has not submitted a password recovery request']);
        $response->assertStatus(200);

        // Create a recovery request for the registered user
        $recoverRequest = Recover_request::create([
            'user_id' => $registeredUser->id,
            'request_status' => false,
            'request_date' => date('Y-m-d'),
        ]);

        // Test case: Password recovery request has not been accepted
        $response = $this->postJson('/api/v0.1/auth/change_password', [
            'organization_id' => '1',
            'password' => 'NewSecurePassword123',
            'confirm_password' => 'NewSecurePassword123',
        ]);
        $response->assertJson([
            'status' => 'error',
            'message' => 'Password recovery request has not been accepted',
        ]);

        $response->assertStatus(200);

        // Update the recovery request status to true
        $recoverRequest->request_status = true;
        $recoverRequest->save();

        // Test case: Invalid input (missing password and/or confirm_password)
        $response = $this->postJson('/api/v0.1/auth/change_password', [
            'organization_id' => '1',
        ]);
        $response->assertJson([
            'status' => 'error',
            'message' => 'The password field is required.',
        ]);
        $response->assertStatus(200);

        // Test case: Invalid input (password and confirm_password do not match)
        $response = $this->postJson('/api/v0.1/auth/change_password', [
            'organization_id' => '1',
            'password' => 'NewSecurePassword123',
            'confirm_password' => 'DifferentSecurePassword123',
        ]);
        $response->assertJson([
            'status' => 'error',
            'message' => 'The confirm password field must match password.',
        ]);
        $response->assertStatus(200);

        // Test case: Successful password change
        $response = $this->postJson('/api/v0.1/auth/change_password', [
            'organization_id' => '1',
            'password' => 'NewSecurePassword123',
            'confirm_password' => 'NewSecurePassword123',
        ]);
        $response->assertJson([
            'status' => 'success',
            'message' => 'Password changed successfully',
        ]);
        $response->assertStatus(200);
    }

    function testCheckRequestStatusApi()
    {
        // Test case: Organization ID not found
        $response = $this->postJson('/api/v0.1/auth/check_request_status', [
            'organization_id' => '999',
        ]);
        $response->assertJson(['status' => 'User has not submitted a request.']);
        $response->assertStatus(200);

        // Create a registered VolunteerUser
        $registeredUser = Volunteer_user::factory()->create([
            'organization_id' => '1',
            'is_registered' => 1,
        ]);

        // Test case: User has not submitted a request
        $response = $this->postJson('/api/v0.1/auth/check_request_status', [
            'organization_id' => '1',
        ]);
        $response->assertJson(['status' => 'User has not submitted a request.']);
        $response->assertStatus(200);

        // Create a recovery request for the registered user
        $recoverRequest = Recover_request::create([
            'user_id' => $registeredUser->id,
            'request_status' => false,
            'request_date' => date('Y-m-d'),
        ]);

        // Test case: Request not yet accepted
        $response = $this->postJson('/api/v0.1/auth/check_request_status', [
            'organization_id' => '1',
        ]);
        $response->assertJson(['status' => 'Request not yet accepted']);
        $response->assertStatus(200);

        // Update the recovery request status to true
        $recoverRequest->request_status = true;
        $recoverRequest->save();

        // Test case: Request accepted
        $response = $this->postJson('/api/v0.1/auth/check_request_status', [
            'organization_id' => '1',
        ]);
        $response->assertJson(['status' => 'Request accepted']);
        $response->assertStatus(200);
    }

    function testGetUserInfo()
    {
        // Create a user
        $user = Volunteer_user::factory()->create(['branch_id' => 1]);

        // Test the getUserInfo API when user_id is provided
        $response = $this->get("/api/v0.1/user/get_user_info/{$user->branch_id}/{$user->id}");
        $response->assertJson([
            'status' => 'success',
            'user' => [
                'id' => $user->id,
                'user_type' => $user->user_type_id === 1 ? 'admin' : 'volunteer',
            ],
        ]);
        $response->assertStatus(200);

        // Test the getUserInfo API when user_id is not provided (get all users in branch 1)
        $response = $this->get("/api/v0.1/user/get_user_info/{$user->branch_id}/null");
        $responseStatus = json_decode($response->getContent(), true)['status'];
        if ($responseStatus === 'error') {
            $response->assertJsonStructure(['status', 'message']);
        } else {
            $response->assertJsonStructure([
                'status',
                'users' => [
                    '*' => ['id', 'user_type'],
                ],
            ]);
        }
        $response->assertStatus(200);

        // Test the getUserInfo API when no users are found
        $response = $this->get('/api/v0.1/user/get_user_info/999/null');
        $response->assertJson([
            'status' => 'error',
            'message' => 'No user(s) found',
        ]);
        $response->assertStatus(200);
    }

    function testLogoutApi()
    {
        // Create a user
        $user = Volunteer_user::factory()->create();

        // Test case: Logout a user
        $response = $this->actingAs($user)->postJson('/api/v0.1/user/logout');

        $response->assertJsonFragment([
            'status' => 'Logged out',
        ]);
        $response->assertStatus(200);

        // Test case: Logout a non-existent user
        // Not needed, as the API will require authentication
    }


}

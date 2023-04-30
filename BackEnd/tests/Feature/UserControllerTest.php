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

    function testLoginApi()
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

    function testGetUserInfoApi()
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

    public function testEditProfileApi()
    {
        // Create a user
        $user = Volunteer_user::factory()->create();

        // Test case: Edit the user's profile
        $newData = [
            'user_id' => $user->id,
            'username' => 'new_username',
            'user_bio' => 'This is a new user bio.',
        ];

        $response = $this->actingAs($user)->postJson('/api/v0.1/user/edit_profile', $newData);

        $response
            ->assertJson([
                'status' => 'success',
                'message' => 'Profile updated successfully',
            ])
            ->assertStatus(200);
    }

    function testGetTrainingsInfoApi()
    {
        // Create volunteer_user, takes, trainings, and programs
        $volunteer_user = Volunteer_user::factory()->create();
        $trainings = Training::factory()
            ->count(5)
            ->create();
        $takes = [];

        foreach ($trainings as $key => $training) {
            if ($key % 2 === 0) {
                $takes[] = Take::factory()->create([
                    'user_id' => $volunteer_user->id,
                    'training_id' => $training->id,
                ]);
            }
        }

        // Test case: User not found
        $response = $this->getJson('/api/v0.1/user/get_trainings_info/999');
        $response->assertStatus(200)->assertJson([
            'status' => 'error',
            'message' => 'User not found',
        ]);

        // Test case: Successful request
        $response = $this->getJson('/api/v0.1/user/get_trainings_info/' . $volunteer_user->id);
        $response->assertStatus(200);

        // Assert trainings and program_counts in the response
        $response->assertJsonStructure(['trainings', 'trainings_not_taken', 'trainings not taken count', 'program_counts' => ['1', '2', '3', '4']]);

        // Assert trainings not taken count
        $trainingsNotTakenCount = count($trainings) - count($takes);
        $response->assertJson([
            'trainings not taken count' => $trainingsNotTakenCount,
        ]);

        // Assert trainings and trainings_not_taken by program
        foreach ($response['trainings'] as $program_id => $trainingsArray) {
            foreach ($trainingsArray as $training) {
                $this->assertArrayHasKey('id', $training);
                $this->assertArrayHasKey('training_name', $training);
                $this->assertArrayHasKey('training_description', $training);
                $this->assertArrayHasKey('program_id', $training);
            }
        }

        foreach ($response['trainings_not_taken'] as $program_id => $trainingsArray) {
            foreach ($trainingsArray as $training) {
                $this->assertArrayHasKey('id', $training);
                $this->assertArrayHasKey('training_name', $training);
                $this->assertArrayHasKey('training_description', $training);
                $this->assertArrayHasKey('program_id', $training);
            }
        }
    }

    function testGetEventsOrganizedApi()
    {
        // Create a volunteer_user
        $volunteer_user = Volunteer_user::factory()->create();

        // Test case: User not found
        $response = $this->getJson('/api/v0.1/user/get_events_organized/999');
        $response->assertStatus(200)->assertJson([
            'status' => 'error',
            'message' => 'User not found',
        ]);

        // Create events and is_responsible records
        $events = Event::factory()
            ->count(5)
            ->create();
        $is_responsible_records = [];

        foreach ($events as $key => $event) {
            $is_responsible_records[] = is_responsible::factory()->create([
                'user_id' => $volunteer_user->id,
                'event_id' => $event->id,
                'role_name' => 'Organizer',
            ]);
        }

        // Test case: Successful request
        $response = $this->getJson('/api/v0.1/user/get_events_organized/' . $volunteer_user->id);
        $response->assertStatus(200);

        // Assert events in the response
        $response->assertJsonStructure([
            'events' => [
                '*' => ['id', 'event_date', 'event_title', 'program_id', 'event_type_id', 'role_name'],
            ],
        ]);

        // Test case: No events found for the user
        $another_volunteer_user = Volunteer_user::factory()->create();
        $response = $this->getJson('/api/v0.1/user/get_events_organized/' . $another_volunteer_user->id);
        $response->assertStatus(200)->assertJson([
            'message' => 'No events found for this user',
        ]);
    }

    public function testGetEventsOrganizedCountApi()
    {
        $user = volunteer_user::factory()->create();
        $events = Event::factory()
            ->count(3)
            ->create();
        foreach ($events as $event) {
            is_responsible::factory()->create([
                'user_id' => $user->id,
                'event_id' => $event->id,
            ]);
        }

        $response = $this->getJson('/api/v0.1/user/get_events_organized_count/' . $user->id);

        $response->assertStatus(200)->assertJson([
            'total_events' => 3,
        ]);
    }

    public function testGetTotalVolunteeringTimeApi()
    {
        $user = volunteer_user::factory()->create([
            'user_start_date' => '2020-01-01',
            'user_end_date' => '2023-01-01',
        ]);

        $response = $this->getJson('/api/v0.1/user/get_total_volunteering_time/' . $user->id);

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'total_time' => '3 Y 0 M',
        ]);
    }

    public function testGetCompletedTrainingsCountApi()
    {
        $user = volunteer_user::factory()->create();
        $trainings_taken = take::factory()
            ->count(4)
            ->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/v0.1/user/get_completed_trainings_count/' . $user->id);

        $response->assertStatus(200)->assertJson([
            'total_trainings' => 4,
        ]);
    }


    public function testGetPostsCountApi()
    {
        $user = volunteer_user::factory()->create();
        $posts = Post::factory()->count(5)->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/v0.1/user/get_posts_count/' . $user->id);

        $response->assertStatus(200)->assertJson([
            'total_posts' => 5
        ]);
    }


    public function testGetCommentsCountApi()
    {
        // Create a user and comments
        $user = volunteer_user::factory()->create();
        $comments = Comment::factory()->count(5)->create(['user_id' => $user->id]);

        // Call the API
        $response = $this->getJson('/api/v0.1/user/get_comments_count/' . $user->id);

        // Check the response
        $response->assertStatus(200)->assertJson([
            'total_comments' => 5,
        ]);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\volunteer_user;
use App\Models\login_attempt;
use App\Models\Recover_request;
use App\Models\Announcement;
use App\Models\event;
use App\Models\is_responsible;
use App\Models\goal;
use App\Models\training;
use App\Models\take;
use App\Models\program;
use App\Models\event_image;
use App\Models\branch;
use App\Models\event_type;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    use WithFaker;

    function testAdminLoginApi()
    {
        // Create an admin user
        $adminUser = Volunteer_user::factory()->create([
            'user_type_id' => 1,
            'password' => Hash::make('adminPassword'),
        ]);

        // Create a non-admin user
        $nonAdminUser = Volunteer_user::factory()->create([
            'user_type_id' => 2,
            'password' => Hash::make('nonAdminPassword'),
        ]);

        // Successful login
        $response = $this->postJson('/api/v0.1/auth/admin_login', [
            'organization_id' => $adminUser->organization_id,
            'password' => 'adminPassword',
        ]);
        $response->assertJson(['status' => 'Login successful']);

        // User not found
        $response = $this->postJson('/api/v0.1/auth/admin_login', [
            'organization_id' => 'nonExistentOrganizationId',
            'password' => 'adminPassword',
        ]);
        $response->assertJson(['status' => 'User not found']);

        // Permission denied
        $response = $this->postJson('/api/v0.1/auth/admin_login', [
            'organization_id' => $nonAdminUser->organization_id,
            'password' => 'nonAdminPassword',
        ]);
        $response->assertJson(['status' => 'Permission denied']);

        // Invalid credentials
        $response = $this->postJson('/api/v0.1/auth/admin_login', [
            'organization_id' => $adminUser->organization_id,
            'password' => 'wrongPassword',
        ]);
        $response->assertJson(['status' => 'Invalid credentials']);

        // Too many failed login attempts
        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/api/v0.1/auth/admin_login', [
                'organization_id' => $adminUser->organization_id,
                'password' => 'wrongPassword',
            ]);
        }
        $response = $this->postJson('/api/v0.1/auth/admin_login', [
            'organization_id' => $adminUser->organization_id,
            'password' => 'adminPassword',
        ]);
        $response->assertJson(['status' => 'Too many failed login attempts']);
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

    function testAddUserApi()
    {
        // Create an admin user
        $adminUser = Volunteer_user::factory()->create([
            'user_type_id' => 1,
            'password' => Hash::make('adminPassword'),
        ]);

        // Successful user creation
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/add_user', [
            'branch_id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'organization_id' => 1,
            'user_dob' => '1990-01-01',
            'user_position' => 'Manager',
            'gender' => 1,
            'user_type_id' => 0,
            'is_active' => 1,
            'user_start_date' => '2023-01-01',
            'user_end_date' => null,
        ]);
        $response->assertJson(['status' => 'success', 'message' => 'User added successfully']);

        // Validation failed
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/add_user', [
            'branch_id' => '',
            'first_name' => '',
            'last_name' => '',
            'organization_id' => '',
            'user_dob' => '',
            'user_position' => '',
            'gender' => '',
            'user_type_id' => '',
            'is_active' => '',
            'user_start_date' => '',
            'user_end_date' => '',
        ]);
        $response->assertJson(['status' => 'Validation failed']);
    }

    public function testEditUserApi()
    {
        // Create a test user
        $user = Volunteer_user::factory()->create();

        // Prepare data for editing the user
        $updatedUserData = [
            'user_id' => $user->id,
            'first_name' => 'UpdatedFirstName',
            'last_name' => 'UpdatedLastName',
            'user_dob' => '1990-01-01',
            'user_position' => 'UpdatedPosition',
            'gender' => 1,
            'user_type_id' => 1,
            'is_active' => 1,
            'user_start_date' => '2023-01-01',
            'user_end_date' => '2024-01-01',
        ];

        // Send a request to edit the user
        $response = $this->postJson('/api/v0.1/admin/edit_user', $updatedUserData);

        // Assert that the response is successful
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'message' => 'User updated successfully',
        ]);

        // Assert that the user was updated in the database
        $this->assertDatabaseHas('volunteer_users', [
            'id' => $user->id,
            'first_name' => $updatedUserData['first_name'],
            'last_name' => $updatedUserData['last_name'],
            'user_dob' => $updatedUserData['user_dob'],
            'user_position' => $updatedUserData['user_position'],
            'gender' => $updatedUserData['gender'],
            'user_type_id' => $updatedUserData['user_type_id'],
            'is_active' => $updatedUserData['is_active'],
            'user_start_date' => $updatedUserData['user_start_date'],
            'user_end_date' => $updatedUserData['user_end_date'],
        ]);
    }

    function testDeleteUserApi()
    {
        // Create an admin user
        $adminUser = Volunteer_user::factory()->create([
            'user_type_id' => 1,
            'password' => Hash::make('adminPassword'),
        ]);

        // Create a volunteer user to delete
        $volunteerUser = Volunteer_user::factory()->create();

        // Successful user deletion
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/delete_user', [
            'user_id' => $volunteerUser->id,
        ]);
        $response->assertJson(['status' => 'success', 'message' => 'User deleted successfully']);
        $this->assertDatabaseMissing('volunteer_users', ['id' => $volunteerUser->id]);

        // User not found
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/delete_user', [
            'user_id' => -1,
        ]);
        $response->assertJson(['status' => 'error', 'message' => 'User not found']);
    }

    function testGetRequestsApi()
    {
        // Create an admin user
        $adminUser = Volunteer_user::factory()->create([
            'user_type_id' => 1,
            'password' => Hash::make('adminPassword'),
        ]);

        // Create branches
        $branch1 = Branch::factory()->create();
        $branch2 = Branch::factory()->create();

        // Create users in different branches
        $user1 = Volunteer_user::factory()->create(['branch_id' => $branch1->id]);
        $user2 = Volunteer_user::factory()->create(['branch_id' => $branch2->id]);

        // Create recover requests for users in different branches
        $request1 = Recover_request::factory()->create(['user_id' => $user1->id]);
        $request2 = Recover_request::factory()->create(['user_id' => $user2->id]);

        // Successful retrieval of requests for a given branch
        $response = $this->actingAs($adminUser)->getJson('/api/v0.1/admin/get_requests/' . $branch1->id);
        $response->assertJson(['status' => 'success']);
        $response->assertJsonFragment(['user_id' => $user1->id]);
        $response->assertJsonMissing(['user_id' => $user2->id]);

        // No requests found
        Recover_request::query()->delete(); // Delete all requests

        $response = $this->actingAs($adminUser)->getJson('/api/v0.1/admin/get_requests/' . $branch1->id);
        $response->assertJson(['status' => 'error', 'message' => 'No requests found']);
    }

    function testAcceptRequestApi()
    {
        // Create an admin user
        $adminUser = Volunteer_user::factory()->create([
            'user_type_id' => 1,
            'password' => Hash::make('adminPassword'),
        ]);

        // Create recover requests
        $recoverRequest1 = Recover_request::factory()->create(['request_status' => 0]);
        $recoverRequest2 = Recover_request::factory()->create(['request_status' => 1]);

        // Successful acceptance of a recover request
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/accept_request', ['request_id' => $recoverRequest1->id]);
        $response->assertJson(['status' => 'success', 'message' => 'Recover request accepted successfully']);

        // Recover request not found
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/accept_request', ['request_id' => 99999]);
        $response->assertJson(['status' => 'error', 'message' => 'Recover request not found']);

        // Recover request has already been accepted
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/accept_request', ['request_id' => $recoverRequest2->id]);
        $response->assertJson(['status' => 'error', 'message' => 'Recover request has already been accepted']);
    }

    function testDeclineRequestApi()
    {
        // Create an admin user
        $adminUser = Volunteer_user::factory()->create([
            'user_type_id' => 1,
            'password' => Hash::make('adminPassword'),
        ]);

        // Create a recover request
        $recoverRequest = Recover_request::factory()->create();

        // Successful decline of a recover request
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/decline_request', ['request_id' => $recoverRequest->id]);
        $response->assertJson(['status' => 'success', 'message' => 'Recover request declined successfully']);

        // Recover request not found
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/decline_request', ['request_id' => 99999]);
        $response->assertJson(['status' => 'error', 'message' => 'Recover request not found']);
    }

    function testSendAnnouncementApi()
    {
        // Create an admin user
        $adminUser = Volunteer_user::factory()->create([
            'user_type_id' => 1,
            'password' => Hash::make('adminPassword'),
        ]);

        // Successful sending of an announcement
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/send_announcement', [
            'announcement_title' => 'Test Announcement',
            'announcement_content' => 'This is a test announcement.',
            'admin_id' => $adminUser->id,
            'importance_level' => 1,
        ]);
        $response->assertJson(['status' => 'success', 'message' => 'Announcement sent successfully']);

        // Invalid importance level
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/send_announcement', [
            'announcement_title' => 'Test Announcement',
            'announcement_content' => 'This is a test announcement.',
            'admin_id' => $adminUser->id,
            'importance_level' => 3,
        ]);
        $response->assertJson(['status' => 'error', 'message' => 'The importance level field is required']);

        // Invalid admin user
        $invalidAdmin = Volunteer_user::factory()->create(['user_type_id' => 0]);
        $response = $this->actingAs($invalidAdmin)->postJson('/api/v0.1/admin/send_announcement', [
            'announcement_title' => 'Test Announcement',
            'announcement_content' => 'This is a test announcement.',
            'admin_id' => $invalidAdmin->id,
            'importance_level' => 1,
        ]);
        $response->assertJson(['status' => 'error', 'message' => 'Invalid admin user']);
    }

    function testDeleteAnnouncementApi()
    {
        // Create an admin user
        $adminUser = Volunteer_user::factory()->create([
            'user_type_id' => 1,
        ]);

        // Create an announcement by the admin user
        $announcement = Announcement::factory()->create([
            'admin_id' => $adminUser->id,
        ]);

        $announcement1 = Announcement::factory()->create([
            'admin_id' => $adminUser->id,
        ]);

        // Successful deletion of the announcement
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/delete_announcement', [
            'announcement_id' => $announcement->id,
            'admin_id' => $adminUser->id,
        ]);

        $response->assertJson(['status' => 'success', 'message' => 'Announcement deleted successfully']);
        $this->assertDatabaseMissing('announcements', ['id' => $announcement->id]);

        // Validation error due to missing required fields
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/delete_announcement', []);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['announcement_id', 'admin_id']);

        // Invalid announcement ID
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/delete_announcement', [
            'announcement_id' => -1,
            'admin_id' => $adminUser->id,
        ]);

        $response->assertJson(['status' => 'error', 'message' => 'Announcement not found']);

        // Invalid admin user
        $nonAdminUser = Volunteer_user::factory()->create(['user_type_id' => 0]);

        $response = $this->actingAs($nonAdminUser)->postJson('/api/v0.1/admin/delete_announcement', [
            'announcement_id' => $announcement1->id,
            'admin_id' => $nonAdminUser->id,
        ]);

        $response->assertJson(['status' => 'error', 'message' => 'User is not an admin']);
    }

    function testEditAnnouncementApi()
    {
        // Create an admin user
        $adminUser = Volunteer_user::factory()->create([
            'user_type_id' => 1,
        ]);

        // Create an announcement by the admin user
        $announcement = Announcement::factory()->create([
            'admin_id' => $adminUser->id,
        ]);

        // Successful edit of the announcement
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/edit_announcement', [
            'announcement_id' => $announcement->id,
            'announcement_title' => 'Updated Title',
            'announcement_content' => 'Updated Content',
            'admin_id' => $adminUser->id,
            'importance_level' => 1,
        ]);

        $response->assertJson(['status' => 'success', 'message' => 'Announcement edited successfully']);
        $this->assertDatabaseHas('announcements', [
            'id' => $announcement->id,
            'announcement_title' => 'Updated Title',
            'announcement_content' => 'Updated Content',
            'importance_level' => 1,
        ]);

        // Invalid announcement ID
        $response = $this->actingAs($adminUser)->postJson('/api/v0.1/admin/edit_announcement', [
            'announcement_id' => -1,
            'announcement_title' => 'Updated Title',
            'announcement_content' => 'Updated Content',
            'admin_id' => $adminUser->id,
            'importance_level' => 1,
        ]);

        $response->assertJson(['status' => 'error', 'message' => 'Announcement not found']);

        // Invalid admin user
        $nonAdminUser = Volunteer_user::factory()->create(['user_type_id' => 0]);

        $response = $this->actingAs($nonAdminUser)->postJson('/api/v0.1/admin/edit_announcement', [
            'announcement_id' => $announcement->id,
            'announcement_title' => 'Updated Title',
            'announcement_content' => 'Updated Content',
            'admin_id' => $nonAdminUser->id,
            'importance_level' => 1,
        ]);

        $response->assertJson(['status' => 'error', 'message' => 'User is not an admin']);
    }

     function testAddEventApi()
    {
        // Create a test program
        $program = Program::factory()->create();

        // Create a test branch
        $branch = Branch::factory()->create();

        // Create test users
        $users = Volunteer_user::factory()
            ->count(2)
            ->create();

        // Prepare data for adding the event
        $eventData = [
            'program_id' => $program->id,
            'event_description' => 'Sample Event Description',
            'event_location' => 'Sample Event Location',
            'event_date' => '2023-06-01',
            'event_title' => 'Sample Event Title',
            'event_type_id' => 1,
            'branch_id' => $branch->id,
            'responsibles' => json_encode([
                [
                    'user_id' => $users[0]->id,
                    'role_name' => 'Role 1',
                ],
                [
                    'user_id' => $users[1]->id,
                    'role_name' => 'Role 2',
                ],
            ]),
        ];

        // Send a request to add the event
        $response = $this->postJson('/api/v0.1/admin/add_event', $eventData);

        // Assert that the response is successful
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'message' => 'Event created successfully',
        ]);

        // Assert that the event was created in the database
        $this->assertDatabaseHas('events', [
            'event_description' => $eventData['event_description'],
            'event_location' => $eventData['event_location'],
            'event_date' => $eventData['event_date'],
            'event_title' => $eventData['event_title'],
            'event_type_id' => $eventData['event_type_id'],
            'program_id' => $eventData['program_id'],
            'branch_id' => $eventData['branch_id'],
        ]);

        // Retrieve the created event
        $event = Event::where('event_title', $eventData['event_title'])->first();

        // Assert that the responsibles were created in the database
        foreach (json_decode($eventData['responsibles'], true) as $responsible) {
            $this->assertDatabaseHas('is_responsibles', [
                'user_id' => $responsible['user_id'],
                'role_name' => $responsible['role_name'],
                'event_id' => $event->id,
            ]);
        }
    }


    function testEditEventApi()
    {

        // Create a volunteer user
        $user = volunteer_user::factory()->create();

        // Create an event
        $event = Event::factory()->create();

        // Create a responsible for the event
        is_responsible::factory()->create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'role_name' => 'Role 1',
            'organization_id' => $user->organization_id,
        ]);

        $imagePath = __DIR__ . '/test-image.jpg';
        $image = new UploadedFile($imagePath, 'test-image.jpg', 'image/jpeg', null, true);

        // Prepare event data to update
        $eventData = [
            'event_id' => $event->id,
            'program_id' => 1,
            'event_main_picture' => $image,
            'budget_sheet' => $image,
            'proposal' => $image,
            'event_description' => 'Updated event description',
            'event_location' => 'Updated event location',
            'event_date' => '2023-06-01',
            'event_title' => 'Updated event title',
            'event_type_id' => 1,
            'responsibles' => json_encode([
                [
                    'user_id' => $user->id,
                    'role_name' => 'Updated Role 1',
                ],
            ]),
            'event_images' => json_encode(['image1.jpg', 'image2.jpg']),
        ];

        // Send a request to edit the event
        $response = $this->actingAs($user)->postJson('/api/v0.1/admin/edit_event', $eventData);

        // Assert that the response has the status "success"
        $response->assertJson([
            'status' => 'success',
        ]);

        // Assert the event has been updated
        $updatedEvent = Event::find($event->id);
        $this->assertEquals($eventData['event_description'], $updatedEvent->event_description);
        $this->assertEquals($eventData['event_location'], $updatedEvent->event_location);
        $this->assertEquals($eventData['event_date'], $updatedEvent->event_date);
        $this->assertEquals($eventData['event_title'], $updatedEvent->event_title);

        // Assert the is_responsible has been updated
        $updatedResponsible = is_responsible::where('event_id', $event->id)->first();
        $this->assertEquals($user->id, $updatedResponsible->user_id);
        $this->assertEquals('Updated Role 1', $updatedResponsible->role_name);

    }



    function testDeleteEventApi()
    {
        // Create a new event
        $event = Event::factory()->create();

        // Send a request to delete the event
        $response = $this->postJson('api/v0.1/admin/delete_event', [
            'event_id' => $event->id,
        ]);

        // Check that the response indicates success
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'message' => 'Event deleted successfully',
        ]);

        // Check that the event was deleted from the database
        $this->assertDatabaseMissing('events', [
            'id' => $event->id,
        ]);

        // Send a request to delete an event that does not exist
        $response = $this->postJson('api/v0.1/admin/delete_event', [
            'event_id' => -1,
        ]);

        // Check that the response indicates failure
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'error',
            'message' => 'Event not found',
        ]);
    }

    function testSetYearlyGoalApi()
    {
        $data = [
            'goal_name' => 'Test Goal',
            'goal_description' => 'This is a test goal',
            'program_id' => 1,
            'number_to_complete' => 10,
            'goal_year' => 2023,
            'event_type_id' => 2,
            'goal_deadline' => '2023-12-31',
            'start_date' => '2023-01-01',
            'branch_id' => 1,
        ];

        $response = $this->json('POST', '/api/v0.1/admin/set_yearly_goal', $data);

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'message' => 'Goal created successfully',
        ]);

        $this->assertDatabaseHas('goals', [
            'goal_name' => 'Test Goal',
            'goal_description' => 'This is a test goal',
            'program_id' => 1,
            'number_to_complete' => 10,
            'goal_year' => 2023,
            'event_type_id' => 2,
            'goal_deadline' => '2023-12-31',
            'start_date' => '2023-01-01',
            'branch_id' => 1,
        ]);
    }

    function testEditYearlyGoalApi()
    {
        // Create a new goal
        $goal = Goal::factory()->create();

        // Make the request to edit the goal
        $response = $this->postJson('/api/v0.1/admin/edit_yearly_goal', [
            'goal_id' => $goal->id,
            'goal_name' => 'New goal name',
            'goal_description' => 'New goal description',
            'program_id' => $goal->program_id,
            'number_to_complete' => $goal->number_to_complete + 1,
            'goal_year' => $goal->goal_year,
            'event_type_id' => $goal->event_type_id,
            'goal_deadline' => $goal->goal_deadline,
            'start_date' => $goal->start_date,
            'branch_id' => $goal->branch_id,
            'number_completed' => $goal->number_completed + 1,
        ]);

        // Assert that the response has a success status
        $response->assertStatus(200);
        $response->assertJson(['status' => 'success', 'message' => 'Goal updated successfully']);

        // Reload the goal from the database to get the updated version
        $goal = $goal->fresh();

        // Assert that the goal was updated with the new values
        $this->assertEquals('New goal name', $goal->goal_name);
        $this->assertEquals('New goal description', $goal->goal_description);
    }

    function testDeleteYearlyGoalApi()
    {
        // Create a new goal
        $goal = Goal::factory()->create();

        // Make a request to delete the goal
        $response = $this->postJson('/api/v0.1/admin/delete_yearly_goal', [
            'goal_id' => $goal->id,
        ]);

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the goal was deleted from the database
        $this->assertDatabaseMissing('goals', [
            'id' => $goal->id,
        ]);
    }

    function testAddTrainingForUserApi()
    {
        // Create a test training
        $training = Training::factory()->create();

        // Create test users
        $users = Volunteer_user::factory()
            ->count(3)
            ->create();

        // Send a request to add the training for the users
        $response = $this->postJson('/api/v0.1/admin/add_training_for_user', [
            'training_ids' => [$training->id],
            'user_ids' => $users->pluck('id')->toArray(),
        ]);

        // Assert that the response is successful
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'message' => 'Trainings added to users successfully',
        ]);

        // Assert that the training was added to the users
        foreach ($users as $user) {
            $this->assertDatabaseHas('takes', [
                'user_id' => $user->id,
                'training_id' => $training->id,
            ]);
        }
    }

    function testDeleteTrainingForUserApi()
    {
        // Create a test training
        $training = Training::factory()->create();

        // Create test users
        $users = Volunteer_user::factory()
            ->count(3)
            ->create();

        // Assign the training to the users
        foreach ($users as $user) {
            Take::create([
                'user_id' => $user->id,
                'training_id' => $training->id,
                'takes_on_date' => \Carbon\Carbon::now(),
            ]);
        }

        // Send a request to remove the training from the users
        $response = $this->postJson('/api/v0.1/admin/delete_training_for_user', [
            'training_ids' => [$training->id],
            'user_ids' => $users->pluck('id')->toArray(),
        ]);

        // Assert that the response is successful
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'message' => 'Trainings removed from users successfully',
        ]);

        // Assert that the training was removed from the users
        foreach ($users as $user) {
            $this->assertDatabaseMissing('takes', [
                'user_id' => $user->id,
                'training_id' => $training->id,
            ]);
        }
    }

    function testAddImageToEventApi()
    {
        // Create a test event
        $event = Event::factory()->create();

        // Create a test image

        $imagePath = __DIR__ . '/test-image.jpg';
        $testImage = new UploadedFile($imagePath, 'test-image.jpg', 'image/jpeg', null, true);

        // Send a request to add the image to the event
        $response = $this->postJson('/api/v0.1/admin/add_event_photo', [
            'event_id' => $event->id,
            'image' => $testImage,
        ]);

        // Assert that the response is successful
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'message' => 'Image created successfully',
        ]);

        // Assert that the image was added to the event
        $this->assertDatabaseHas('event_images', [
            'event_id' => $event->id,
            'event_image_source' => $testImage->hashName(),
        ]);
    }

    function testRemoveImageFromEventApi()
    {
        // Create a test event
        $event = Event::factory()->create();

        // Create a test image
        $imagePath = __DIR__ . '/test-image.jpg';
        $testImage = new UploadedFile($imagePath, 'test-image.jpg', 'image/jpeg', null, true);

        // Add the test image to the event
        $eventImage = event_image::create([
            'event_id' => $event->id,
            'event_image_source' => $testImage->hashName(),
        ]);

        // Send a request to remove the image from the event
        $response = $this->postJson('/api/v0.1/admin/remove_image', [
            'id' => $eventImage->id,
        ]);

        // Assert that the response is successful
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'message' => 'Image deleted successfully',
        ]);

        // Assert that the image was removed from the event
        $this->assertDatabaseMissing('event_images', [
            'id' => $eventImage->id,
            'event_id' => $event->id,
            'event_image_source' => $testImage->hashName(),
        ]);
    }
}

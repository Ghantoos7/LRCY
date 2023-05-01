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

    public function testGetRequests()
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
}

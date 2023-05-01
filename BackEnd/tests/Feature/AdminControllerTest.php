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

class AdminControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    use WithFaker;


    public function testAdminLogin()
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
}

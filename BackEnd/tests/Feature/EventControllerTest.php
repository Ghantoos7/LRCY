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
use App\Models\goal;
use App\Models\event;
use App\Models\announcement;
use App\Models\volunteer_user;
use App\Models\event_image;
use App\Models\is_responsible;
use App\Models\program;
use App\Models\event_type;
use App\Models\training;
use App\Models\branch;

class EventControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    use WithFaker;

    function testGetYearlyGoalsApi()
    {
        $branch = branch::factory()->create();
        $program = Program::factory()->create();
        $goals = Goal::factory()
            ->count(3)
            ->create([
                'branch_id' => $branch->id,
                'goal_year' => date('Y'),
                'program_id' => $program->id,
            ]);

        $response = $this->getJson('/api/v0.1/event/get_yearly_goals/' . $branch->id);

        $response->assertStatus(200)->assertJson([
            'goals' => [
                $program->id => $goals
                    ->map(function ($goal) {
                        return [
                            'id' => $goal->id,
                            'goal_description' => $goal->goal_description,
                            'goal_name' => $goal->goal_name,
                            'program_id' => $goal->program_id,
                            'goal_status' => boolval($goal->goal_status),
                            'number_completed' => $goal->number_completed,
                            'number_to_complete' => $goal->number_to_complete,
                            'goal_year' => intval($goal->goal_year),
                            'event_type_id' => $goal->event_type_id,
                            'goal_deadline' => $goal->goal_deadline,
                            'start_date' => $goal->start_date,
                            'branch_id' => intval($goal->branch_id),
                        ];
                    })
                    ->toArray(),
            ],
        ]);
    }
}

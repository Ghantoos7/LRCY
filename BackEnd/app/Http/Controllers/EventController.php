<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\goal;
use App\Models\event;


class EventController extends Controller{
    //

    // Gets yearly goals and return them grouped based on program id
    public function get_yearly_goals(){
        $year = date('Y');
        $goals = goal::select('goal_description', 'goal_name', 'program_id', 'goal_status', 'number_completed', 'goal_year', 'event_type_id', 'goal_deadline')->where('goal_year', $year)->get();
        $goals = $goals->groupBy('program_id');
        return response()->json($goals);
    }


    function get_event_info($event_id = null) {
    
    // Retrieve the event information from the database
    $events = $event_id ? [Event::find($event_id)] : Event::all();

    // If no event(s) found, return an error message
    if (count($events) === 0 || $events[0] === null) {
        return response()->json([
            'message' => 'Event not found'
        ]);
    }

    // Remove unnecessary fields from event(s) information
    $eventsArray = array_map(function($event) {
        unset($event['field1'], $event['field2'], $event['created_at'], $event['updated_at']);
        return $event;
    }, collect($events)->toArray());

    // Group events by program_id
    $eventsArray = collect($eventsArray)->groupBy('program_id');

    // Return the event(s) information grouped by program_id
    return response()->json($event_id ? ['event' => $eventsArray->first()] : ['events' => $eventsArray]);


    }
}

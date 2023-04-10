<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\goal;

class EventController extends Controller{
    //

    // get yearly goals and return them grouped based on program id
    public function get_yearly_goals(){
        $year = date('Y');
        $goals = goal::select('goal_description', 'goal_name', 'program_id', 'goal_status', 'number_completed', 'goal_year', 'event_type_id', 'goal_deadline')->where('goal_year', $year)->get();
        $goals = $goals->groupBy('program_id');
        return response()->json($goals);
    }


}

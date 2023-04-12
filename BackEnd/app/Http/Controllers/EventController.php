<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\goal;
use App\Models\event;
use App\Models\announcement;
use App\Models\volunteer_user;
use App\Models\picture;


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


    function get_announcements() {
        // Retrieve the announcements from the database and return them in descending order of creation date (newest first) and paginate them
        $announcements = Announcement::orderBy('announcement_date', 'desc')->paginate(5);
    
        // If no announcements found, return an error message
        if ($announcements->isEmpty()) {
            return response()->json([
                'message' => 'Announcements not found'
            ]);
        }
        // Transform the announcements to include the announcer's name and profile picture
        $announcements = $announcements->map(function($announcement) {
            $announcementArray = $announcement->toArray();
            // Get the announcer's name and last name and profile picture
            $announcer = Volunteer_user::find($announcement->admin_id);

            if ($announcer){
            $announcementArray['announcer_name'] = $announcer->first_name . ' ' . $announcer->last_name;
            $announcementArray['announcer_profile_picture'] = $announcer->profile_picture;
            }
            // Remove unnecessary fields from the announcement
            unset($announcementArray['field1'], $announcementArray['field2'], $announcementArray['created_at'], $announcementArray['updated_at']);
            return $announcementArray;
        });

        // Return the announcements
        return response()->json(['announcements' => $announcements]);
    }



    function get_event_pictures($event_id) {

        // If no event id is provided, return an error message
        $existing_event = Event::find($event_id);
        if (!$existing_event) {
            return response()->json([
                'message' => 'Event not found'
            ]);
        }

        // Retrieve the pictures of the event from the database
        $pictures = Picture::where('event_id', $event_id)->get();

        // If no pictures found, return an error message
        if ($pictures->isEmpty()) {
            return response()->json([
                'message' => 'Pictures not found'
            ]);
        }

        // Remove unnecessary fields from the pictures
        $pictures = $pictures->map(function($picture) {
            $pictureArray = $picture->toArray();
            unset($pictureArray['field1'], $pictureArray['field2'], $pictureArray['created_at'], $pictureArray['updated_at']);
            return $pictureArray;
        });

        // Return the pictures
        return response()->json(['pictures' => $pictures]);
    }



}
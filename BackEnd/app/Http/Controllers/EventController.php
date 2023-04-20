<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\goal;
use App\Models\event;
use App\Models\announcement;
use App\Models\volunteer_user;
use App\Models\event_image;
use App\Models\is_responsible;
use App\Models\program;


class EventController extends Controller {


    function getYearlyGoals() {

        // Gets yearly goals and return them grouped based on program id

        $year = date('Y');

        $goals = goal::select('goal_description', 'goal_name', 'program_id', 'goal_status', 'number_completed', 'number_to_complete', 'goal_year', 'event_type_id', 'goal_deadline')->where('goal_year', $year)->get();

        $goals = $goals->groupBy('program_id')->toArray();

        // add the field program_name to each goal
        foreach ($goals as $program_id => $goalsArray) {
            foreach ($goalsArray as $goalIndex => $goal) {
                $goals[$program_id][$goalIndex]['program_name'] = Program::find($program_id)->program_name;
            }
        }

        return response()->json([
            'goals' => $goals,
        ]);    

    }
    

    function getEventInfo($event_id = null) {
    
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

        // Adds a list of users who were responsible of each event, theyre first name last name role anme and profile picture
        $eventsArray = $eventsArray->map(function($events) {
            return $events->map(function($event) {
                $event['responsibles'] = Is_responsible::where('event_id', $event['id'])->get()->map(function($responsible) {
                    $user = Volunteer_user::find($responsible->user_id);
                    return [
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'role_name' => $responsible->role_name,
                        'profile_picture' => $user->user_profile_pic
                    ];
                });
                return $event;
            });
        });

        // Return the event(s) information grouped by program_id
        return response()->json($event_id ? ['event' => $eventsArray->first()] : ['events' => $eventsArray]);
    
    }


    function getAnnouncements() {

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

            // Convert the importance level to string
            switch($announcementArray['importance_level']) {
                case 0:
                    $announcementArray['importance_level'] = 'optional';
                    break;
                case 1:
                    $announcementArray['importance_level'] = 'important';
                    break;
                case 2:
                    $announcementArray['importance_level'] = 'urgent';
                    break;
                default:
                    break;
            }

            return $announcementArray;
        });
        
        // Return the announcements
        return response()->json(['announcements' => $announcements]);
    
    }

    
    function getEventPictures($event_id) {

        // If no event id is provided, return an error message
        $existing_event = Event::find($event_id);
        if (!$existing_event) {
            return response()->json([
                'message' => 'Event not found'
            ]);
        }

        // Retrieve the pictures of the event from the database
        $pictures = Event_image::where('event_id', $event_id)->get();

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

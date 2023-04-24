<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\volunteer_user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\login_attempt;
use App\Models\Recover_request;
use App\Models\Announcement;
use App\Models\event;
use App\Models\is_responsible;
use App\Models\goal;
use App\Models\training;
use App\Models\take;
use App\Models\program;

class AdminController extends Controller {


    function adminLogin(Request $request) {

        $request->validate([
            'organization_id' => 'required',
            'password' => 'required',
        ]);
    
        // Finds the user in the database
        $user = volunteer_user::where('organization_id', $request->organization_id)->first();
    
        if(!$user) {
            return response()->json([
                'status' => 'User not found',
            ]);
        }
    
        if($user->user_type_id !== 1){
            return response()->json([
                'status' => 'Permission denied',
            ]);
        }
    
        // Checks if the user has exceeded the maximum number of login attempts
        if ($this->hasExceededLoginAttempts($request->organization_id)) {
            return response()->json([
                'status' => 'Too many failed login attempts',
            ]);
        }
    
        // Checks if the password is correct
        if(Hash::check($request->password, $user->password)){
            $this->resetLoginAttempts($request->organization_id);
            // Creates a new token for the user
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status' => 'Login successful',
                'user' => $user,
                'token' => $token
            ]);
        }
        else{
            // Adds a failed login attempt to the database if the user has inputted the wrong password
            $this->addFailedLoginAttempt($request->organization_id);
            return response()->json([
                'status' => 'Invalid credentials',
            ]);
        }
    
    }    
  

    function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return response()->json([
            "status" => "Logged out",
        ]);
    }
    

    // Adds a failed login attempt to the database if the user has inputted the wrong password
    private function addFailedLoginAttempt($organization_id) {

        login_attempt::create([
        'login_attempt_time' => date('H:i:s'),
        'login_attempt_date' => date('Y-m-d'),
        'organization_id' => $organization_id,
        ]);

    }


    // Checks if the user has exceeded the maximum number of login attempts
    private function hasExceededLoginAttempts($organization_id) {
        
        $last_attempt = login_attempt::where('organization_id', '=', $organization_id)->latest()->first();

        // Check if there is no previous login attempt made by the user
        if (!$last_attempt) {
            return false;
        }

        // Check if the last login attempt was made more than 24 hours ago
        $last_attempt_time = strtotime($last_attempt->login_attempt_date.' '.$last_attempt->login_attempt_time);
        $current_time = time();
        $hours_since_last_attempt = ($current_time - $last_attempt_time) / 3600;
        if ($hours_since_last_attempt >= 24) {
            $this->resetLoginAttempts($organization_id);
            return false;
        }

        // Check if the user has exceeded the maximum number of login attempts
        $total_attempts = login_attempt::where('organization_id', '=', $organization_id)->count();
        return ($total_attempts >= 5);

    }


    // Resets the number of login attempts to 0
    private function resetLoginAttempts($organization_id) {

        login_attempt::where('organization_id', '=', $organization_id)->delete();

    }


    function addUser(Request $request) {
        
        $validator = Validator::make($request->all(), [
            "admin_branch_id" => "required|integer",
            "first_name" => "required|string",
            "last_name" => "required|string",
            "organization_id" => "required|integer",
            "date_of_birth" => "required|date",
            "position" => "required|string",
            "gender" => "required|string",
            "user_type_id" => "required|integer|in:0,1",
            "status" => "required|string",
            "start_date" => "required|date",
            "end_date" => "nullable|date",
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                "status" => "Validation failed",
                "errors" => $validator->errors()
            ]);
        }
    
        // check gender input(male:0,female:1,other:2) and convert to integer
        $genderInput = $request->input('gender');
        if ($genderInput === 'male') {
            $gender = 0;
        } else if ($genderInput === 'female') {
            $gender = 1;
        } else if ($genderInput === 'other') {
            $gender = 2;
        } else {
            return response()->json([
                "status" => "Invalid gender input"
            ]);
        }
    
        try {
            $user = volunteer_user::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'organization_id' => $request->input('organization_id'),
                'user_dob' => $request->input('date_of_birth'),
                'user_position' => $request->input('position'),
                'gender' => $gender,
                'branch_id' => $request->input('admin_branch_id'),
                'user_type_id' => $request->input('user_type_id'),
                'status' => $request->input('status'),
                'user_start_date' => $request->input('start_date'),
                'user_end_date' => $request->input('end_date'),
                'user_age' => Carbon::parse($request->input('date_of_birth'))->age,
                'is_registered' => 0,
                'is_active' => ($request->input('status') == 'active') ? 1 : 0,
                'password' => Hash::make('default_password'),
                'username' => $request->input('first_name') . $request->input('last_name')
            ]);
    
            return response()->json([
                "status" => "User added successfully",
                "user" => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "User could not be added",
                "error" => $e->getMessage()
            ]);
        }

    }
    

    function editUser(Request $request) {

        try {
            $user = Volunteer_user::where('id', $request->input('user_id'))->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ]);
            }

            $fillableFields = ['first_name', 'last_name', 'is_active', 'user_start_date', 'user_end_date', 'branch_id', 'user_position', 'user_type_id'];

            $user->fill($request->only($fillableFields));

            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the user',
                'error' => $e->getMessage()
            ]);
        }

    }


    function deleteUser(Request $request) {

        try {
            $user = Volunteer_user::where('id', $request->input('user_id'))->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ]);
            }

            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while deleting the user',
                'error' => $e->getMessage()
            ]);
        }

    }


    function getRequests($branch_id) {
        // Get all the requests regardless of branch
        $requests = Recover_request::where('request_status', 0)->get();
    
        // get the user IDs of the users who made the requests and check if they are in the same branch as the one provided
        $user_ids = $requests->pluck('user_id')->toArray();
    
        $users = Volunteer_user::whereIn('id', $user_ids)->where('branch_id', $branch_id)->get();
    
        // Get the user IDs of the users who are in the same branch as the one provided
        $user_ids = $users->pluck('id')->toArray();
    
        // Get the requests that are made by users in the same branch as the one provided, and make fields hidden, and return the user who made the request. check for null values
        $requests = $requests->whereIn('user_id', $user_ids)->map(function ($request) {
            $request->makeHidden(['field1', 'field2', 'created_at', 'updated_at']);
            $request->user = Volunteer_user::where('id', $request->user_id)->first();
            return $request;
        });
    
        // Return the requests or an error message if no requests are found
        if ($requests->count() > 0) {
            return response()->json([
                'status' => 'success',
                'requests' => $requests
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No requests found'
            ]);
        }
    }
    


    function acceptRequest(Request $request) {

        // Validate the request
        $request->validate([
            'request_id' => 'required|integer'
        ]);

        // Get the recover request based on the provided request ID
        $recoverRequest = Recover_request::where('id', $request->input('request_id'))->first();

        // Check if the recover request exists
        if (!$recoverRequest) {
            return response()->json([
                'status' => 'error',
                'message' => 'Recover request not found'
            ]);
        }

        // Check if the request has already been accepted
        if ($recoverRequest->request_status == 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Recover request has already been accepted'
            ]);
        }

        // Update the request status to accepted
        $recoverRequest->request_status = 1;
        $recoverRequest->save();

        // Return a success response
        return response()->json([
            'status' => 'success',
            'message' => 'Recover request accepted successfully'
        ]);
    
    }


    function declineRequest(Request $request) {

        // Validate the request
        $request->validate([
            'request_id' => 'required|integer'
        ]);

        // Get the recover request based on the provided request ID
        $recoverRequest = Recover_request::where('id', $request->input('request_id'))->first();

        // Check if the recover request exists
        if (!$recoverRequest) {
            return response()->json([
                'status' => 'error',
                'message' => 'Recover request not found'
            ]);
        }

        // delete the request
        $recoverRequest->delete();

        // Return a success response
        return response()->json([
            'status' => 'success',
            'message' => 'Recover request declined successfully'
        ]);

    }


    function sendAnnouncement(Request $request) {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'announcement_title' => 'required|string',
            'announcement_content' => 'required|string',
            'admin_id' => 'required|integer',
            'importance_level' => 'required|integer'
        ]);
    
        // Check if validation failed and return the errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ]);
        }

        // Check if the importance level is valid
        if ($request->input('importance_level') < 0 || $request->input('importance_level') > 2) {
            return response()->json([
                'status' => 'error',
                'message' => 'The importance level field is required'
            ]);
        }
    
        // Get the admin user based on the provided admin ID
        $admin = volunteer_user::where('id', $request->input('admin_id'))->first();
    
        // Check if the admin user exists and is an admin
        if (!$admin || $admin->user_type_id != 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid admin user'
            ]);
        }
    
        // Create the announcement
        $announcement = Announcement::create([
            'announcement_title' => $request->input('announcement_title'),
            'announcement_content' => $request->input('announcement_content'),
            'admin_id' => $request->input('admin_id'),
            'importance_level' => $request->input('importance_level'),
            'branch_id' => $admin->branch_id,
            'announcement_date' => Carbon::now()
        ]);
    
        // Return a success response
        return response()->json([
            'status' => 'success',
            'message' => 'Announcement sent successfully'
        ]);
    }
    


    function deleteAnnouncement(Request $request) {

        // Validate the request
        $request->validate([
            'announcement_id' => 'required|integer',
            'admin_id' => 'required|integer'
        ]);

        // Get the announcement based on the provided announcement ID
        $announcement = Announcement::where('id', $request->input('announcement_id'))->first();

        // Check if the announcement exists
        if (!$announcement) {
            return response()->json([
                'status' => 'error',
                'message' => 'Announcement not found'
            ]);
        }

        // Get the admin user based on the provided admin ID
        $admin = volunteer_user::where('id', $request->input('admin_id'))->first();

        // Check if the admin user exists
        if (!$admin) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }

        // Check if the admin user is an admin
        if ($admin->user_type_id != 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'User is not an admin'
            ]);
        }

        // Check if the admin user is the one who sent the announcement
        if ($admin->id != $announcement->admin_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'User is not the one who sent the announcement'
            ]);
        }

        // Delete the announcement
        $announcement->delete();

        // Return a success response
        return response()->json([
            'status' => 'success',
            'message' => 'Announcement deleted successfully'
        ]);

    }


    function editAnnouncement(Request $request) {

        // Validate the request
        $request->validate([
            'announcement_id' => 'required|integer',
            'admin_id' => 'required|integer',
            'announcement_title' => 'nullable|string',
            'announcement_content' => 'nullable|string',
            'importance_level' => 'nullable|integer'
        ]);

        // Get the announcement based on the provided announcement ID
        $announcement = Announcement::where('id', $request->input('announcement_id'))->first();

        // Check if the announcement exists
        if (!$announcement) {
            return response()->json([
                'status' => 'error',
                'message' => 'Announcement not found'
            ]);
        }

        // Check if the importance level is valid
        if ($request->input('importance_level') < 0 || $request->input('importance_level') > 2) {
            return response()->json([
                'status' => 'error',
                'message' => 'The importance level field is required'
            ]);
        }

        // Get the admin user based on the provided admin ID
        $admin = volunteer_user::where('id', $request->input('admin_id'))->first();

        // Check if the admin user exists
        if (!$admin) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }

        // Check if the admin user is an admin
        if ($admin->user_type_id != 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'User is not an admin'
            ]);
        }

        // Check if the admin user is the one who sent the announcement
        if ($admin->id != $announcement->admin_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'User is not the one who sent the announcement'
            ]);
        }

        // Update the announcement
        if ($request->has('announcement_content')) {
            $announcement->announcement_content = $request->input('announcement_content');
        }

        if ($request->has('importance_level')) {
            $announcement->importance_level = $request->input('importance_level');
        }

        $announcement->save();

        // Return a success response
        return response()->json([
            'status' => 'success',
            'message' => 'Announcement edited successfully'
        ]);

    }


    function addEvent(Request $request) {

        // validate the request
        $validator = Validator::make($request->all(), [
            'program_id' => 'required|integer',
            'event_main_picture' => 'required|string',
            'event_description' => 'required|string',
            'event_location' => 'required|string',
            'event_date' => 'required|date',
            'event_title' => 'required|string',
            'event_type_id' => 'required|integer',
            'budget_sheet' => 'required|string',
            'proposal' => 'required|string',
            'meeting_minute' => 'nullable|string',
            'branch_id' => 'required|integer',
            'responsibles' => 'required|array',
            'responsibles.*.user_id' => 'required|integer',
            'responsibles.*.role_name' => 'required|string',
        ]);
        
        // checks if validation worked
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }
        
        // try catch block to handle the exception and add the event

        try {
            // Create the event
            $event = Event::create([
                'event_main_picture' => $request->input('event_main_picture'),
                'event_description' => $request->input('event_description'),
                'event_location' => $request->input('event_location'),
                'event_date' => $request->input('event_date'),
                'event_title' => $request->input('event_title'),
                'event_type_id' => $request->input('event_type_id'),
                'program_id' => $request->input('program_id'),
                'budget_sheet' => $request->input('budget_sheet'),
                'proposal' => $request->input('proposal'),
                'meeting_minute' => $request->input('meeting_minute'),
                'branch_id' => $request->input('branch_id'),
            ]);

        }catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error creating event',
                    'message' => $e->getMessage()
                ]);
        }

        // Create the responsibles
        try {

            foreach ($request->input('responsibles') as $responsible) {
                // Get the user based on the provided organization id
                $user = volunteer_user::where('id', $responsible['user_id'])->first();
                is_responsible::create([
                    'user_id' => $responsible['user_id'],
                    'role_name' => $responsible['role_name'],
                    'event_id' => $event->id
                ]);
            }

        }catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error adding responsibilities',
                    'message' => $e->getMessage()
                ]);
        }
        
        
        // in the goals table, increment all rows that have the same program id and event type id as the event that was just created
        $goals = Goal::where('program_id', $event->program_id)->where('event_type_id', $event->event_type_id)->get();
        foreach ($goals as $goal) {
            $this->goalIncrement($goal);
            
        }
        // Return a response indicating success
        return response()->json(['message' => 'Event created successfully']);

    }

    
    function editEvent(Request $request)  {

        try {
            // Find the event by event_id
            $event = Event::where('id', $request->input('event_id'))->first();
    
            if (!$event) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Event not found'
                ]);
            }

             // in the goals table, decrement all rows that have the same program id and event type id as the event that was just edited
             $goals = Goal::where('program_id', $event->program_id)->where('event_type_id', $event->event_type_id)->get();
             foreach ($goals as $goal) {
                    $eventDate = date('Y-m-d', strtotime($event->event_date));
                // Decrements if the event is the same year as the goal
                if ($goal->goal_year == date('Y', strtotime($eventDate))) {
                        $this->goalDecrement($goal);
                    }

             }
 
            
            // Update event details from the request
            $fillableFields = [
                'event_main_picture',
                'event_description',
                'event_location',
                'event_date',
                'event_title',
                'event_type_id',
                'program_id',
                'budget_sheet',
                'proposal',
                'meeting_minute',
            ];
            $event->fill($request->only($fillableFields));
            $event->save();

            // in the goals table, increment all rows that have the same program id and event type id as the event that was just created

            $goals = Goal::where('program_id', $event->program_id)->where('event_type_id', $event->event_type_id)->get();
            foreach ($goals as $goal) {
                
                $eventDate = date('Y-m-d', strtotime($event->event_date));
                // Decrements if the event is the same year as the goal
                if ($goal->goal_year == date('Y', strtotime($eventDate))) {
                    $this->goalIncrement($goal);
                }

                }   
  
            // Update responsible people for the event
            $responsibles = $request->input('responsibles', []);
    
            // Delete existing responsible people from is_responsible table
            is_responsible::where('event_id', $event->event_id)->delete();
    
            // Add new responsible people to is_responsible table
            foreach ($responsibles as $responsible) {
                 // Get the user based on the provided organization id
                $user = volunteer_user::where('organization_id', $responsible['organization_id'])->first();
                is_responsible::create([
                    'event_id' => $event->id,
                    'user_id' => $responsible['user_id'],
                    'role_name' => $responsible['role_name']
                ]);
            }
 
            return response()->json([
                'status' => 'success',
                'message' => 'Event updated successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the event',
                'error' => $e->getMessage()
            ]);
        }

    }

    
    function deleteEvent(Request $request) {

        try {
            // Find the event by event_id
            $event = Event::where('id', $request->input('event_id'))->first();
    
            if (!$event) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Event not found'
                ]);
            }


            // Remove the responsibles for the event
            is_responsible::where('event_id', $event->id)->delete();
            
            // remove a complete goal counter if the event is deleted
            $goals = Goal::where('program_id', $event->program_id)->where('event_type_id', $event->event_type_id)->get();
            foreach ($goals as $goal) {  

                $eventDate = date('Y-m-d', strtotime($event->event_date));
                // Decrements if the event is the same year as the goal
                if ($goal->goal_year == date('Y', strtotime($eventDate))) {
                    $this->goalDecrement($goal);
                }
            }
    
            // Delete the event
            $event->delete();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Event deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while deleting the event',
                'error' => $e->getMessage()
            ]);
        }

    }


    function setYearlyGoal(Request $request) {
        
        // Validate the request with the data type
        $validator = Validator::make($request->all(), [
            'goal_name' => 'required|string',
            'goal_description' => 'required|string',
            'program_id' => 'required|integer',
            'number_to_complete' => 'required|integer',
            'goal_year' => 'required|integer',
            'event_type_id' => 'required|integer',
            'goal_deadline' => 'required|date',
            'start_date' => 'required|date',
            'branch_id' => 'required|integer,',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }        


        try {
            // Create the goal
            $goal = Goal::create([
                'goal_name' => $request->input('goal_name'),
                'goal_description' => $request->input('goal_description'),
                'program_id' => $request->input('program_id'),
                'goal_status' => 0,
                'number_to_complete' => $request->input('number_to_complete'),
                'number_completed' => 0,
                'goal_year' => $request->input('goal_year'),
                'event_type_id' => $request->input('event_type_id'),
                'goal_deadline' => $request->input('goal_deadline'),
                'start_date' => $request->input('start_date'),
                'branch_id' => $request->input('branch_id'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error creating goal',
                'error' => $e->getMessage()
            ]);
        }

        // Return a response indicating success
        return response()->json(['message' => 'Goal created successfully']);

    }


    function editYearlyGoal(Request $request) {

        try{

            $validate = Validator::make($request->all(), [
                'goal_id' => 'required|integer',
                'goal_name' => 'required|string',
                'goal_description' => 'required|string',
                'program_id' => 'required|integer',
                'number_to_complete' => 'required|integer',
                'goal_year' => 'required|integer',
                'event_type_id' => 'required|integer',
                'goal_deadline' => 'required|date',
                'start_date' => 'required|date',
                'branch_id' => 'required|integer',
            ]);

            // Check if the validation fails

            if ($validate->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validate->errors()
                ]);
            }


            $goal = Goal::where('id', $request->input('goal_id'))->first();
            if (!$goal) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Goal not found'
                ]);
            }
    
            // Update goal details from the request
            $fillableFields = [
                'goal_name',
                'goal_description',
                'program_id',
                'number_to_complete',
                'goal_year',
                'event_type_id',
                'goal_deadline',
                'start_date',
                'branch_id',
            ];
            $goal->fill($request->only($fillableFields));
            $goal->save();

            // Reset number completed 
            $goal->number_completed = 0;
            $goal->number_completed = $request->input('number_completed');
            $goal->save();

            // Get all events for the goal
            $events = Event::where('program_id', $goal->program_id)->where('event_type_id', $goal->event_type_id)->get();

            // Loop through the events and increment the goal counter if the event is the same year as the goal
            foreach ($events as $event) {
                $eventDate = date('Y-m-d', strtotime($event->event_date));
                if ($goal->goal_year == date('Y', strtotime($eventDate))) {
                    $this->goalIncrement($goal);
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Goal updated successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the goal',
                'error' => $e->getMessage()
            ]);
        }
    
    }

    function deleteYearlyGoal(Request $request) {

        try {
            $goal = Goal::where('id', $request->input('goal_id'))->first();
            if (!$goal) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Goal not found'
                ]);
            }
    
            // Delete the goal
            $goal->delete();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Goal deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while deleting the goal',
                'error' => $e->getMessage()
            ]);
        }
    }


    private function goalIncrement($goal) {
 
        $goal->number_completed = $goal->number_completed + 1;

        // if the number completed is equal to the number of events, then the goal is completed
        if ($goal->number_completed == $goal->number_to_complete) {
            $goal->goal_status = 1;
        }
        $goal->save();

    } 


    private function goalDecrement($goal) {

        if($goal->number_completed > 0){
            $goal->number_completed = $goal->number_completed - 1;
        }
    
        // if the number completed is equal to the number of events, then the goal is completed
        if ($goal->number_completed < $goal->number_to_complete) {
            $goal->goal_status = 0;
        }
        
        $goal->save();

    }


    function addTrainingForUser(Request $request) {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'training_ids' => 'required|array',
            'user_ids' => 'required|array',
            'user_ids.*' => 'integer',
            'training_ids.*' => 'integer'
        ]);
    
        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }
    
        // Get the list of trainings and check if they exist
        $trainings = Training::findMany($request->input('training_ids'));
        if ($trainings->count() != count($request->input('training_ids'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'One or more trainings do not exist'
            ]);
        }
    
        // Get the list of users and check if they exist
        $users = Volunteer_user::findMany($request->input('user_ids'));
        if ($users->count() != count($request->input('user_ids'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'One or more users do not exist'
            ]);
        }
    
        // Loop through the users and add the trainings to the users in a try catch block and return a success message or an error message if an error occurs
        try {
            foreach ($users as $user) {
                foreach ($trainings as $training) {
                    // Check if the user has already taken this training
                    $existing_take = Take::where('user_id', $user->id)
                        ->where('training_id', $training->id)
                        ->first();

                    // If the user has not taken this training before, create a new Take record
                    if (!$existing_take) {
                        $take = new Take([
                            'user_id' => $user->id,
                            'training_id' => $training->id,
                            'takes_on_date' => \Carbon\Carbon::now()
                        ]);
                        $take->save();
                    }
                }
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Trainings added to users successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
      
    }    


    function editTrainingForUser(Request $request) {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'training_id' => 'required|integer',
            'user_id' => 'required|integer',
            'takes_on_date' => 'required|date'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }

        // Get the training and check if it exists
        $training = Training::find($request->input('training_id'));
        if (!$training) {
            return response()->json([
                'status' => 'error',
                'message' => 'Training not found'
            ]);
        }

        // Get the user and check if it exists
        $user = Volunteer_user::find($request->input('user_id'));
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }

        // Get the take record and check if it exists
        $take = Take::where('user_id', $user->id)->where('training_id', $training->id)->first();
        if (!$take) {
            return response()->json([
                'status' => 'error',
                'message' => 'User did not take this training yet'
            ]);
        }

        // Update the take record in a try catch block and return a success message or an error message if it fails
        try {
            $take->takes_on_date = $request->input('takes_on_date');
            $take->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Training updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update training'
            ]);
        }
    
    }


    function deleteTrainingForUser(Request $request) {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'training_id' => 'required|integer',
            'user_id' => 'required|integer'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }

        // Get the training and check if it exists
        $training = Training::find($request->input('training_id'));
        if (!$training) {
            return response()->json([
                'status' => 'error',
                'message' => 'Training not found'
            ]);
        }

        // Get the user and check if it exists
        $user = Volunteer_user::find($request->input('user_id'));
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }

        // Get the take record and check if it exists
        $take = Take::where('user_id', $user->id)->where('training_id', $training->id)->first();
        if (!$take) {
            return response()->json([
                'status' => 'error',
                'message' => 'User did not take this training yet'
            ]);
        }

        // Delete the take record in a try catch block and return an error message if it fails
        try {
            $take->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Training deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete the training'
            ]);
        }

    }


    function addTraining(Request $request) {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'program_id' => 'required|integer',
            'training_name' => 'required|string',
            'training_description' => 'required|string'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }

        // Get the program and check if it exists
        $program = Program::find($request->input('program_id'));
        if (!$program) {
            return response()->json([
                'status' => 'error',
                'message' => 'Program not found'
            ]);
        }

        // Create the training and return a success message or error message if the training was not created
        try {
            Training::create([
                'program_id' => $program->id,
                'training_name' => $request->input('training_name'),
                'training_description' => $request->input('training_description')
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Training created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create the training'
            ]);
        }

    }


    function editTraining(Request $request) {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'training_id' => 'required|integer',
            'program_id' => 'integer',
            'training_name' => 'string',
            'training_description' => 'string'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }

        // Get the training and check if it exists
        $training = Training::find($request->input('training_id'));
        if (!$training) {
            return response()->json([
                'status' => 'error',
                'message' => 'Training not found'
            ]);
        }

        // Get the program if it was sent and check if it exists
        if ($request->has('program_id')) {
            $program = Program::find($request->input('program_id'));
            if (!$program) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Program not found'
                ]);
            }
        }

        // Update the training fields that were sent in a try catch block and return a success message or an error message if it fails
        try {
            if ($request->has('program_id')) {
                $training->program_id = $program->id;
            }
            if ($request->has('training_name')) {
                $training->training_name = $request->input('training_name');
            }
            if ($request->has('training_description')) {
                $training->training_description = $request->input('training_description');
            }
            $training->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Training updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update training'
            ]);
        }

    }


    function deleteTraining(Request $request) {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'training_id' => 'required|integer'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }

        // Get the training and check if it exists
        $training = Training::find($request->input('training_id'));
        if (!$training) {
            return response()->json([
                'status' => 'error',
                'message' => 'Training not found'
            ]);
        }

        // Delete the training in a try catch block and return an error message if it fails
        try {
            $training->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Training deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete the training'
            ]);
        }

    }


}
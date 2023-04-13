<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\volunteer_user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\login_attempt;
use App\Models\Branch;
use App\Models\Recover_request;
use App\Models\Announcement;
use App\Models\event;
use App\Models\is_responsible;
use App\Models\goal;

class AdminController extends Controller
{


    // Validate the password
    private function validatePassword($password) {
        $errors = array();
        
        if (strlen($password) < 8) {
            $errors[] = 'Password must be at least 8 characters long.';
        }
        
        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = 'Password must contain at least one lowercase letter.';
        }
        
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = 'Password must contain at least one uppercase letter.';
        }

        if (!preg_match('/\d/', $password)) {
            $errors[] = 'Password must contain at least one digit.';
        }
        
        return $errors;
    }


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
    
        // Checks if the password is valid
        $errors = $this->validatePassword($request->password);
        if (count($errors) > 0) {
            return response()->json([
                'status' => $errors,
            ]);
        }
    
        // Checks if the user has exceeded the maximum number of login attempts
        if ($this->hasExceededLoginAttempts($request->organization_id)) {
            return response()->json([
                'status' => 'Too many failed login attempts',
            ]);
        }
    
        // Checks if the password needs to be rehashed
        if (Hash::needsRehash($user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
        }
    
        // Checks if the password is correct
        if(Hash::check($request->password, $user->password)){
            $this->resetLoginAttempts($request->organization_id);
            return response()->json([
                'status' => $user
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


    // Adds a failed login attempt to the database if the user has inputted the wrong password
    private function addFailedLoginAttempt($organization_id) {

        login_attempt::create([
        'login_attempt_time' => date('H:i:s'),
        'login_attempt_date' => date('Y-m-d'),
        'user_id' => $organization_id,
    ]);
    }


    // Checks if the user has exceeded the maximum number of login attempts
    private function hasExceededLoginAttempts($organization_id) {
        
        $total_attempts = login_attempt::where('user_id', '=', $organization_id)->count();
        return ($total_attempts >= 5);
    }


    // Resets the number of login attempts to 0
    private function resetLoginAttempts($organization_id) {
        login_attempt::where('user_id', '=', $organization_id)->delete();
    }


    function addUser(Request $request) {
        
        $validator = Validator::make($request->all(), [
            "first_name" => "required|string",
            "last_name" => "required|string",
            "organization_id" => "required|integer",
            "date_of_birth" => "required|date",
            "position" => "required|string",
            "gender" => "required|string",
            "branch" => "required|string",
            "user_type_id" => "required|integer|in:0,1",
            "status" => "required|string",
            "start_date" => "required|date",
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

        $branch = Branch::where('branch_name', $request->input('branch'))->first();
    
        if (!$branch) {
            return response()->json([
                "status" => "Branch not found"
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
                'branch_id' => $branch->id,
                'user_type_id' => $request->input('user_type_id'),
                'status' => $request->input('status'),
                'user_start_date' => $request->input('start_date'),
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
        $request->validate([
            'announcement_content' => 'required|string',
            'admin_id' => 'required|integer',
            'importance_level' => 'required|integer'
        ]);

        // Get the admin user based on the provided admin ID
        $admin = volunteer_user::where('id', $request->input('admin_id'))->first();

        // Check if the admin user exists
        if (!$admin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Admin user not found'
            ]);
        }

        // Check if the admin user is an admin
        if ($admin->user_type_id != 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'User is not an admin'
            ]);
        }

        // Create the announcement
        $announcement = Announcement::create([
            'announcement_content' => $request->input('announcement_content'),
            'admin_id' => $request->input('admin_id'),
            'importance_level' => $request->input('importance_level'),
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

    public function addEvent(Request $request) {
        // validate the request

        $validator = Validator::make($request->all(), [
            'event_main_picture' => 'required|string',
            'event_description' => 'required|string',
            'event_location' => 'required|string',
            'event_date' => 'required|date',
            'event_title' => 'required|string',
            'event_type_id' => 'required|integer',
            'budget_sheet' => 'required|string',
            'proposal' => 'required|string',
            'meeting_minute' => 'nullable|string',
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
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error creating event'
            ]);
        }

       // adds the array of responsible people to the is responsible table
        foreach ($request->input('responsibles') as $responsible) {
            try {
                // Create the responsible
                $is_responsible = is_responsible::create([
                    'user_id' => $responsible['user_id'],
                    'event_id' => $event->id,
                    'role_name' => $responsible['role_name'],
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error creating responsible'
                ]);
            }
        }

        // in the goals table, increment all rows that have the same program id and event type id as the event that was just created
        $goals = Goal::where('program_id', $event->program_id)->where('event_type_id', $event->event_type_id)->get();
        foreach ($goals as $goal) {
            $this->goalIncrement($goal);
            
        }
        // Return a response indicating success
        return response()->json(['message' => 'Event created successfully']);
    }


    
    public function editEvent(Request $request)  {

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
                 $this->goalDecrement($goal);
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
                'meeting_minute'
            ];
            $event->fill($request->only($fillableFields));
            $event->save();

            // in the goals table, increment all rows that have the same program id and event type id as the event that was just created

            $goals = Goal::where('program_id', $event->program_id)->where('event_type_id', $event->event_type_id)->get();
            foreach ($goals as $goal) {
                $this->goalIncrement($goal);
                }   
  
            // Update responsible people for the event
            $responsibles = $request->input('responsibles', []);
    
            // Delete existing responsible people from is_responsible table
            is_responsible::where('event_id', $event->event_id)->delete();
    
            // Add new responsible people to is_responsible table
            foreach ($responsibles as $responsible) {
                Is_responsible::create([
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

    

    public function deleteEvent(Request $request)
    {

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
                $this->goalDecrement($goal);
                    
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



    public function setYearlyGoal(Request $request)
    {
        
        // Validate the request with the data type
        $validator = Validator::make($request->all(), [
            'goal_name' => 'required|string',
            'goal_description' => 'required|string',
            'program_id' => 'required|integer',
            'number_to_complete' => 'required|integer',
            'goal_year' => 'required|integer',
            'event_type_id' => 'required|integer',
            'goal_deadline' => 'required|date',
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



}

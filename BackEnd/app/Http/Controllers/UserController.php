<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\volunteer_user;
use App\Models\recover_request;
use App\Models\take;
use App\Models\training;
use App\Models\login_attempt;
use App\Models\registration_attempt;
use App\Models\post;
use App\Models\comment;
use App\Models\is_responsible;
use App\Models\event;


class UserController extends Controller{


    function signup(Request $credentials) {
    
        // Get the organization ID from the request
        $organization_id = $credentials->input('organization_id');

        // Retrieve a volunteer user record from the database based on the `organization_id` input parameter
        $existing_volunteer_user = volunteer_user::where('organization_id', '=', $organization_id)->first();
        
        // Determine the status message based on the existence and registration status of the volunteer user
        $status = $existing_volunteer_user ? ($existing_volunteer_user->is_registered ? 'Organization ID found, user already registered' : 'Organization ID found, user not registered') : 'Organization ID not found';
        
        // Return a JSON response with the status message and appropriate HTTP status code
        return response()->json([

            'status' => $status

        ]);

    }

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


    function register(Request $request) {

        // Validate the request input
        $validator = Validator::make($request->all(), [
            'organization_id' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
    
            return response()->json([
                'status' => 'Invalid input',
                'errors' => $errors,
            ]);
        }
    
        // Validate the password using the validatePassword() function
        $password_errors = $this->validatePassword($request->input('password'));
    
        if (!empty($password_errors)) {
            $status = 'Invalid password: ' . implode(', ', $password_errors);
    
            return response()->json([
                'status' => $status,
            ]);
        }
    
        // Retrieve a volunteer user record from the database based on the `organization_id` input parameter
        $existing_volunteer_user = volunteer_user::where('organization_id', '=', $request->input('organization_id'))->first();
    
        // Check if the volunteer user exists in the database
        if (!$existing_volunteer_user) {
            return response()->json([
                'status' => 'Organization ID not found',
            ]);
        }
    
        // Check if the volunteer user is already registered
        if ($existing_volunteer_user->is_registered) {
            return response()->json([
                'status' => 'Organization ID found, user already registered',
            ]);
        }
    
        // Set the is_registered, username and password attributes of the user object and save it to the database
        $existing_volunteer_user->is_registered = 1;
        $existing_volunteer_user->username = $request->input('username');
        $existing_volunteer_user->password = Hash::make($request->input('password'));
        $existing_volunteer_user->save();
    
        // Return a JSON response with the appropriate status message and HTTP status code
        return response()->json([
            'status' => 'Organization ID found, user registered successfully',
        ]);

    }
    

    function login(Request $credentials) {
        
        // Checks if the user has exceeded the maximum number of login attempts
        if ($this->hasExceededLoginAttempts($credentials->organization_id)) {
            return response()->json([
                "status" => "Too many failed login attempts",
            ]);
        }
        
        $check_user = volunteer_user::where("organization_id", $credentials->organization_id)->first();
        
        // Checks if the user exists in the database
        if(!$check_user) {
            return response()->json([
                "status" => "Invalid credentials",
            ]);
        }
    
        // Checks if the user is registered
        if(!$check_user->is_registered){
            return response()->json([
                "status" => "Invalid credentials",
            ]);
        }
    
        // Checks if the password needs to be rehashed
        if (Hash::needsRehash($check_user->password)) {
            $check_user->password = Hash::make($credentials->password);
            $check_user->save();
        }
    
        // Checks if the password is correct
        if(Hash::check($credentials->password, $check_user->password)){
            $this->resetLoginAttempts($credentials->organization_id);
            return response()->json([
                "status" => $check_user,
            ]);
        }
        else{
            // Adds a failed login attempt to the database if the user has inputted the wrong password
            $this->addFailedLoginAttempt($credentials->organization_id);
            return response()->json([
                "status" => "Invalid credentials",
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

    

    function recover_request(Request $request) {

        // Get organization ID from request input
        $organization_id = $request->input('organization_id');

        // Retrieve a volunteer user record from the database based on the `organization_id` input parameter
        $existing_volunteer_user = volunteer_user::where('organization_id', '=', $organization_id)->first();

        // Check if user has already submitted a request
        $existing_request = $existing_volunteer_user ? recover_request::where('user_id', '=', $existing_volunteer_user->id)->first() : null;
        
        // Get current date
        $request_date = date('Y-m-d');
        
        // Return a JSON response based on whether the user exists and is registered, and whether they have already submitted a recovery request or not. If the user exists and is registered, and has not already submitted a request, create a new recovery request and return a success message. If the user has already submitted a request, return an error message. If the user does not exist or is not registered, return a relevant error message.
        return $existing_volunteer_user && $existing_volunteer_user->is_registered ? (!$existing_request ? ((new recover_request(['user_id' => $existing_volunteer_user->id, 'request_status' => false, 'request_date' => $request_date]))->save() ? response()->json(['status' => 'Password recovery request sent successfully']) : response()->json(['status' => 'Failed to create password recovery request'])) : response()->json(['status' => 'User has already submitted a request.'])) : response()->json(['status' => ($existing_volunteer_user ? 'User is not registered' : 'Organization ID not found')]);

    }
    

    function change_password(Request $request) {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'organization_id' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        // Validate password
        $password_errors = $this->validatePassword($request->input('password'));

        // Check if validation failed or there are password errors
        if ($validator->fails() || !empty($password_errors)) {
            $errors = $validator->errors();
            foreach ($password_errors as $error) {
                $errors->add('password', $error);
            }
            return response()->json([
                'status' => 'error',
                'message' => $errors
            ]);
        }

        // Retrieve a volunteer user record from the database based on the `organization_id` input parameter
        $existing_volunteer_user = volunteer_user::where('organization_id', '=', $request->input('organization_id'))->first();

        // Check if the user exists and is registered. If yes, update the password and return a success response. If no, return an error response.
        return $existing_volunteer_user && $existing_volunteer_user->is_registered ? response()->json(['status' => $existing_volunteer_user->password = Hash::make($request->input('password')) ? 'success' : 'error', 'message' => $existing_volunteer_user->password = Hash::make($request->input('password')) ? 'Password changed successfully' : 'Failed to update password']) : response()->json(['status' => 'error', 'message' => $existing_volunteer_user ? 'User is not registered' : 'Organization ID not found']);
            
    }

    
    function get_user_info($user_id = null) {

        // Retrieve the user information from the database
        $users = $user_id ? [volunteer_user::find($user_id)] : volunteer_user::all();
        // If no user(s) found, return a 404 response
        if (count($users) === 0 || $users[0] === null) {
            return response()->json([    
                'message' => 'User not found'
        ]);
        }
    
        // Remove password field from user(s) information
        $usersArray = array_map(function($user) {
        unset($user['password'],$user['field1'],$user['field2'],$user['created_at'],$user['updated_at']);
        return $user; 
        }, 
    
        collect($users)->toArray()); // Return the user(s) information
        return response()->json($user_id ? ['user' => $usersArray[0]] : ['users' => $usersArray]);
    }
        
    
    function get_total_trainings($user_id) {
        // Find the user
        $existing_volunteer_user = volunteer_user::find($user_id);
        if (!$existing_volunteer_user) {
            return response()->json(['status' => 'error', 'message' => 'User not found']);
        }
    
        // Get the user's takes
        $user_takes = Take::where('user_id', $user_id)->get();
    
        // Get the training IDs of the user's takes
        $training_ids = $user_takes->pluck('training_id')->toArray();
    
        // Get the trainings with the matching IDs
        $trainings = Training::whereIn('id', $training_ids)->select('id', 'training_name', 'training_description', 'program_id')->get();
    
        // If no trainings are found for the user
        if ($trainings->isEmpty()) {
            return response()->json(['message' => 'No trainings found for this user']);
        }
    
        // Sort the trainings based on program ID
        $trainings = $trainings->sortBy('program_id');
    
        // Remove any fields that are not needed
        $trainingsArray = $trainings->map(function ($training) {
            return [
                'id' => $training->id,
                'training_name' => $training->training_name,
                'training_description' => $training->training_description,
                'program_id' => $training->program_id
            ];
        });

        // gets trainings that the user did not do by diffrencing the list of trainings he took and the list of all trainings
        $trainingsNotTaken = Training::whereNotIn('id', $training_ids)->select('id', 'training_name', 'training_description', 'program_id')->get();
        $trainingsNotTakenCount = count($trainingsNotTaken);

        # stores the trainings what are not taken in a 2d array based on program
        $trainingsNotTakenByProgram = [];
        foreach ($trainingsNotTaken as $training) {
            if (!array_key_exists($training['program_id'], $trainingsNotTakenByProgram)) {
                $trainingsNotTakenByProgram[$training['program_id']] = [];
            }
            array_push($trainingsNotTakenByProgram[$training['program_id']], $training);
        }


        // Stores the trainings in 2d array based on program
        $trainingsByProgram = [];
    
        // Loop through the trainings
        foreach ($trainingsArray as $training) {
            // If the program ID is not in the array, add it
            if (!array_key_exists($training['program_id'], $trainingsByProgram)) {
                $trainingsByProgram[$training['program_id']] = [];
            }
            // Add the training to the array
            array_push($trainingsByProgram[$training['program_id']], $training);
        }
    
        // Calculate the count of trainings in each program
        $programCounts = [];
        foreach ($trainingsByProgram as $programId => $trainings) {
            $programCounts[$programId] = count($trainings);
        }
    
        // Return the total count of trainings, the trainings themselves, and the counts of trainings in each program
        return response()->json(['trainings' => $trainingsByProgram,'trainings_not_taken' => $trainingsNotTakenByProgram,'trainings not taken count' => $trainingsNotTakenCount,'program_counts' => $programCounts, ]);
    }
    


    function get_events_organized($user_id) {
        // Find the user
        $existing_volunteer_user = volunteer_user::find($user_id);
    
        if (!$existing_volunteer_user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }
    
        // Get the user's events
        $events_responsible = is_responsible::where('user_id', $user_id)->get();
    
        // Get the event IDs of the user's events
        $event_ids = $events_responsible->pluck('event_id')->toArray();
    
        // Get the events with the matching IDs
        $events = Event::whereIn('id', $event_ids)->select('id', 'event_date', 'event_title', 'program_id', 'event_type_id')->get();
    
        $events = $events->map(function ($event) use ($user_id) {
            $event['role_name'] = is_responsible::where('event_id', $event['id'])->where('user_id', $user_id)->first()->role_name;
            return $event;
        });
    
        // If the user did not organize any events
        if ($events->isEmpty()) {
            return response()->json([
                'message' => 'No events found for this user'
            ]);
        }
    
        // Remove any fields that are not needed
        $eventsArray = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'event_date' => $event->event_date,
                'event_title' => $event->event_title,
                'program_id' => $event->program_id,
                'event_type_id' => $event->event_type_id,
                'role_name' => $event->role_name
            ];
        })->toArray();
    
        // Return the total count and the events
        return response()->json([
            'events' => $eventsArray
        ]);
    }
    

    function get_organized_events_count($user_id) {
                
                // Find the user
                $existing_volunteer_user = volunteer_user::find($user_id);
        
                if (!$existing_volunteer_user) {
                    return response()->json(
                        ['status' => 'error', 
                        'message' => 'User not found'
                    ]);
                }
        
                // Get the user's events
                $events_responsible = is_responsible::where('user_id', $user_id)->get();
    
                // Get the event IDs of the user's events
                $event_ids = $events_responsible->pluck('event_id')->toArray();
    
                // Get the events with the matching IDs
                $events = Event::whereIn('id', $event_ids)->get();
        
                // If the user did not organize any events
                if ($events->isEmpty()) {
                    return response()->json([
                        'message' => 'No events found for this user'
                    ]);
                }
        
                // Return the total count of events
                return response()->json([
                    'total_events' => count($events)
                ]);
    
    }


    function get_total_volunteering_time($user_id) {

        // Find the user
        $existing_volunteer_user = volunteer_user::find($user_id);

        if (!$existing_volunteer_user) {
            return response()->json(['status' => 'error', 
            'message' => 'User not found'
        ]);
        }

        // Calculate the start and end dates
        $start_date = Carbon::parse($existing_volunteer_user->user_start_date);
        $end_date = $existing_volunteer_user->user_end_date ? Carbon::parse($existing_volunteer_user->user_end_date) : Carbon::now();

        // Calculate the total volunteering time
        $diffInMonths = $start_date->diffInMonths($end_date);
        $diffInYears = floor($diffInMonths / 12);
        $diffInMonths = $diffInMonths % 12;

        $total_time = ($diffInYears > 0 ? $diffInYears . " year" . ($diffInYears > 1 ? "s " : " ") : "") . ($diffInMonths > 0 ? $diffInMonths . " month" . ($diffInMonths > 1 ? "s" : "") : "");

        // Return the response
        return response()->json(['status' => 'success', 'total_time' => $total_time]);

    }


    function get_completed_trainings_count($user_id) {
                    
        // Find the user
        $existing_volunteer_user = volunteer_user::find($user_id);
            
        if (!$existing_volunteer_user) {
            return response()->json(
                ['status' => 'error', 
                'message' => 'User not found'
                ]);
        }
        // Get the user's trainings
        $trainings_taken = take::where('user_id', $user_id)->get();
        
        // If the user did not take any trainings
        if ($trainings_taken->isEmpty()) {
            return response()->json([
            'message' => 'No trainings found for this user'
             ]);
          }
            
            // Return the total count of trainings
            return response()->json([
            'total_trainings' => count($trainings_taken)
         ]);

    }


    function get_posts_count($user_id) {

        // Find the user
        $existing_volunteer_user = volunteer_user::find($user_id);

        if (!$existing_volunteer_user) {
            return response()->json(
                ['status' => 'error', 
                'message' => 'User not found'
            ]);
        }

        // Get the user's posts
        $posts = Post::where('user_id', $user_id)->get();

        // If no posts are found for the user
        if ($posts->isEmpty()) {
            return response()->json([
                'message' => 'No posts found for this user'
            ]);
        }

        // Return the total count of posts
        return response()->json([
            'total_posts' => count($posts)
        ]);


    }


    function get_comments_count($user_id) {

        // Find the user
        $existing_volunteer_user = volunteer_user::find($user_id);

        if (!$existing_volunteer_user) {
            return response()->json(
                ['status' => 'error', 
                'message' => 'User not found'
            ]);
        }

        // Get the user's comments
        $comments = Comment::where('user_id', $user_id)->get();

        // If no comments are found for the user
        if ($comments->isEmpty()) {
            return response()->json([
                'message' => 'No comments found for this user'
            ]);
        }

        // Return the total count of comments
        return response()->json([
            'total_comments' => count($comments)
        ]);

    }


    function get_total_likes_received($user_id) {
            
            // Find the user
            $existing_volunteer_user = volunteer_user::find($user_id);
    
            if (!$existing_volunteer_user) {
                return response()->json(
                    ['status' => 'error', 
                    'message' => 'User not found'
                ]);
            }
    
            // Get the user's posts
            $posts = Post::where('user_id', $user_id)->get();

            // Get the user's comments
            $comments = Comment::where('user_id', $user_id)->get();
    
            // Total likes received = sum of likes on posts + sum of likes on comments
            $total_likes_received = $posts->sum('like_count') + $comments->sum('comment_like_count');

            return response()->json([
                'total_likes_received' => $total_likes_received
            ]);
    

    }


    
    function get_total_trainings_left($user_id) {

        // Find the user
        $existing_volunteer_user = volunteer_user::find($user_id);

        if (!$existing_volunteer_user) {
            return response()->json(
                ['status' => 'error', 
                'message' => 'User not found'
            ]);
        }

        // get the IDs of all trainings the user has taken
        $user_training_ids = take::where('user_id', $user_id)->pluck('training_id')->toArray();

        // get the IDs of all trainings
        $training_ids = training::pluck('id')->toArray();

        // get the IDs of all trainings the user has not taken
        $trainings_left_ids = array_diff($training_ids, $user_training_ids);

        // get the total count of trainings the user has not taken
        $total_trainings_left = count($trainings_left_ids);

        return response()->json([
            'total_trainings_left' => $total_trainings_left
        ]);

    }


    function get_own_posts($user_id){

        // Find the user
        $existing_volunteer_user = volunteer_user::find($user_id);

        if (!$existing_volunteer_user) {
            return response()->json(
                ['status' => 'error', 
                'message' => 'User not found'
            ]);
        }

        // Get the user's posts
        $posts = Post::where('user_id', $user_id)->get();

        // If the user did not post anything
        if ($posts->isEmpty()) {
            return response()->json([
                'message' => 'No posts found for this user'
            ]);
        }

        // Return the posts
        return response()->json([
            'posts' => $posts
        ]);

    }   

 }



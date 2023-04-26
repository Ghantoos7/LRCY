<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\volunteer_user;
use App\Models\recover_request;
use App\Models\take;
use App\Models\training;
use App\Models\login_attempt;
use App\Models\post;
use App\Models\comment;
use App\Models\is_responsible;
use App\Models\event;
use App\Models\branch;


class UserController extends Controller {


    function signup(Request $credentials) {
    
        // Get the organization ID from the request
        $organization_id = $credentials->input('organization_id');

        // Retrieve a volunteer user record from the database based on the `organization_id` input parameter
        $existing_volunteer_user = volunteer_user::where('organization_id', '=', $organization_id)->first();
        
        // Determine the status message based on the existence and registration status of the volunteer user
        $status = $existing_volunteer_user ? ($existing_volunteer_user->is_registered ? 'Organization ID found, user already registered' : 'Organization ID found, user not registered') : 'Organization ID not found';
        
        // Return a JSON response with the status message
        return response()->json([

            'status' => $status

        ]);

    }

    
    private function validatePassword($password) {

        // Function to validate the password

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
            'confirm_password' => 'required|same:password'
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
            $status = 'Invalid password';
            $errors = $password_errors;
            return response()->json([
                'status' => $status,
                'errors' => $errors,
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
        if ($existing_volunteer_user->is_registered == 1) {
            return response()->json([
                'status' => 'Organization ID found, user already registered',
            ]);
        }
    
        // Set the is_registered, username and password attributes of the user object and save it to the database
        $existing_volunteer_user->is_registered = 1;
        $existing_volunteer_user->username = $request->input('username');
        $existing_volunteer_user->password = Hash::make($request->input('password'));
        $existing_volunteer_user->save();

        $token = $existing_volunteer_user->createToken('auth_token')->plainTextToken;
        
        // Return a JSON response with the appropriate status message and HTTP status code
        return response()->json([
            'status' => 'Organization ID found, user registered successfully',
            'token' => $token,
        ]);

    }
    

    function login(Request $credentials) {

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

        if(!$check_user->is_active){
            return response()->json([
                "status" => "Invalid credentials",
            ]);
        }

        // Check if the user has exceeded the maximum number of login attempts
        if ($this->hasExceededLoginAttempts($credentials->organization_id)) {
            // Check the last login attempt time
            $last_attempt = login_attempt::where('organization_id', '=', $credentials->organization_id)->orderBy('created_at', 'desc')->first();
            $now = Carbon::now();
            $last_attempt_time = Carbon::parse($last_attempt->created_at);
            $diff_in_hours = $last_attempt_time->diffInHours($now);
    
            // If the last login attempt was more than 24 hours ago, clear the login attempts and allow the user to log in
            if ($diff_in_hours >= 24) {
                $this->resetLoginAttempts($credentials->organization_id);
            } else {
                return response()->json([
                    "status" => "Too many failed login attempts",
                ]);
            }
        }
    
        // Checks if the password is correct
        if(Hash::check($credentials->password, $check_user->password)){
            $this->resetLoginAttempts($credentials->organization_id);
            // Creates a new token for the user
            $token = $check_user->createToken('authToken')->plainTextToken;
            $user_id = $check_user->id;
            return response()->json([
                "status" => 'Login successful',
                "token" => $token,
                "user_id" => $user_id,
                "username" => $check_user->username,
                "user_profile_pic" => $check_user->user_profile_pic,
                'branch_id' => $check_user->branch_id,
                "full_name" => $check_user->first_name . " " . $check_user->last_name,
            ]);
        } else {
            // Adds a failed login attempt to the database if the user has inputted the wrong password
            $this->addFailedLoginAttempt($credentials->organization_id);
            return response()->json([
                "status" => "Invalid credentials",
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
            'login_attempt_time' => Carbon::now()->format('H:i:s'),
            'login_attempt_date' => Carbon::now()->format('Y-m-d'),
            'organization_id' => $organization_id,
        ]);
    }
    

    // Checks if the user has exceeded the maximum number of login attempts
    private function hasExceededLoginAttempts($organization_id) {
        $total_attempts = login_attempt::where('organization_id', '=', $organization_id)->count();
        return ($total_attempts >= 5);
    }
    

    // Resets the number of login attempts to 0
    private function resetLoginAttempts($organization_id) {
        login_attempt::where('organization_id', '=', $organization_id)->delete();
    }
    

    function recoverRequest(Request $request) {

        // Get organization ID from request input
        $organization_id = $request->input('organization_id');

        // Retrieve a volunteer user record from the database based on the `organization_id` input parameter
        $existing_volunteer_user = volunteer_user::where('organization_id', '=', $organization_id)->first();

        // Check if user has already submitted a request
        $existing_request = $existing_volunteer_user ? recover_request::where('user_id', '=', $existing_volunteer_user->id)->first() : null;
        
        // Get current date
        $request_date = date('Y-m-d');
        
        // Return a JSON response based on whether the user exists and is registered, and whether they have already submitted a recovery request or not. If the user exists and is registered, and has not already submitted a request, create a new recovery request and return a success message. If the user has already submitted a request, return an error message. If the user does not exist or is not registered, return a relevant error message.
        return $existing_volunteer_user && $existing_volunteer_user->is_registered ? (!$existing_request ? ((new recover_request(['user_id' => $existing_volunteer_user->id, 'request_status' => false, 'request_date' => $request_date]))->save() ? response()->json(['status' => 'Recovery request sent successfully!']) : response()->json(['status' => 'Failed to create password recovery request'])) : response()->json(['status' => 'User has already submitted a request.'])) : response()->json(['status' => ($existing_volunteer_user ? 'User is not registered' : 'Organization ID not found')]);

    }
    
    function checkRequestStatus(Request $request){
        // Get organization ID from request input
        $organization_id = $request->input('organization_id');
    
        // Retrieve a volunteer user record from the database based on the `organization_id` input parameter
        $existing_volunteer_user = volunteer_user::where('organization_id', '=', $organization_id)->first();
    
        // Check if user has already submitted a request
        $existing_request = $existing_volunteer_user ? recover_request::where('user_id', '=', $existing_volunteer_user->id)->first() : null;
    
        // Return a JSON response based on whether the request_status is true or false. If the request_status is true, return a success message. If the request_status is false, return an error message.
        return $existing_request ? ($existing_request->request_status ? response()->json(['status' => 'Request accepted']) : response()->json(['status' => 'Request not yet accepted'])) : response()->json(['status' => 'User has not submitted a request.']);
    }

    function changePassword(Request $request) {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'organization_id' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);
    
        // Get the user ID from the organization ID of the request
        $user_id = volunteer_user::where('organization_id', '=', $request->input('organization_id'))->first()->id;

        // Check this user's recover request,  If it is false(0) then return an error response stating that it has not yet been accepted. If it is true(1) then continue with the password change. If it is null, then return an error response stating that the user has not submitted a request.
        $existing_request = recover_request::where('user_id', '=', $user_id)->first();
    
        if (!$existing_request) {
            return response()->json([
                'status' => 'error',
                'message' => 'User has not submitted a password recovery request'
            ]);
        }
    
        if ($existing_request->request_status === 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Password recovery request has not been accepted'
            ]);
        }
    
        // Validate password
        $password_errors = $this->validatePassword($request->input('password'));
    
        // Check if validation failed or there are password errors and return the status and message
        if ($validator->fails() || $password_errors) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->fails() ? $validator->errors()->first() : $password_errors
            ]);
        }


    
        // Retrieve a volunteer user record from the database based on the `organization_id` input parameter
        $existing_volunteer_user = volunteer_user::where('organization_id', '=', $request->input('organization_id'))->first();
    
        // Check if the user exists and is registered. If yes, update the password and save the record. If no, return an error response.
        if ($existing_volunteer_user && $existing_volunteer_user->is_registered) {
            $existing_volunteer_user->password = Hash::make($request->input('password'));
            $existing_volunteer_user->save();
            $existing_request->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Password changed successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $existing_volunteer_user ? 'User is not registered' : 'User not found'
            ]);
        }

    }    

    
    function getUserInfo($branch_id, $user_id = null) {
        
        // Retrieve the user information from the database
        if ($user_id) {
            $users = [volunteer_user::find($user_id)];
        } else {
            $users = volunteer_user::where('branch_id',$branch_id)->get();

        }
    
        // If no user(s) found, return an error response
        if ($users[0] === null || $users[0] === [] ) {
            return response()->json([
                'status' => 'error',
                'message' => 'No user(s) found'
            ]);
        }


        // Remove specified fields (password, field1, field2, created_at, and updated_at) from user(s) information using unset() and handle case where user_id is specified (i.e. return a single user object instead of an array of user objects) and add to each user a field called 'user_type' which is either 'volunteer' or 'admin' depending on the value of user_type_id (1 for admin, 0 for volunteer)
        $usersArray = [];
        foreach ($users as $user) {
            unset($user->password);
            unset($user->field1);
            unset($user->field2);
            unset($user->created_at);
            unset($user->updated_at);
            $user->user_type = $user->user_type_id === 1 ? 'admin' : 'volunteer';
            $usersArray[] = $user;
        }

    
        // Return the user(s) information and pagination links
        return response()->json($user_id ? ['status' => 'success', 'user' => $usersArray[0]] : [
            'status' => 'success',
            'users' => $usersArray,
        ]);
        
    }
    

    function getTrainingsInfo($user_id) {

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
        $specificProgramCounts = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
        ];
    
        foreach ($trainingsByProgram as $program_id => $trainings) {
            $programCounts[$program_id] = count($trainings);
            
            // Count the trainings taken in specific programs (1, 2, 3, 4)
            if (array_key_exists($program_id, $specificProgramCounts)) {
                $specificProgramCounts[$program_id] = count($trainings);
            }
        }
    
        // Return the total count of trainings, the trainings themselves, and the counts of trainings in each program
        return response()->json(['trainings' => $trainingsByProgram,'trainings_not_taken' => $trainingsNotTakenByProgram,'trainings not taken count' => $trainingsNotTakenCount,'program_counts' => $specificProgramCounts]);
   
    }
    

    function getEventsOrganized($user_id) {

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
        
        $events = $events->sortByDesc('event_date');
    
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

        // sort the events based on date from newest to oldest  
        usort($eventsArray, function ($a, $b) {
            return strtotime($b['event_date']) - strtotime($a['event_date']);
        });
    
        // Return the total count and the events
        return response()->json([
            'events' => $eventsArray
        ]);
    }
    

    function getEventsOrganizedCount($user_id) {
                
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
        
        // Return the total count of events
        return response()->json([
            'total_events' => count($events)
        ]);
    
    }


    function getTotalVolunteeringTime($user_id) {

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

        $total_time = ($diffInYears > 0 ? $diffInYears . " Y "  : "") . ($diffInMonths . " M");

        // Return the response
        return response()->json(['status' => 'success', 'total_time' => $total_time]);

    }


    function getCompletedTrainingsCount($user_id) {
                    
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
        
    
            // Return the total count of trainings
            return response()->json([
            'total_trainings' => count($trainings_taken)
         ]);

    }


    function getPostsCount($user_id) {

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

        // Return the total count of posts
        return response()->json([
            'total_posts' => count($posts)
        ]);

    }


    function getCommentsCount($user_id) {

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

        // Return the total count of comments
        return response()->json([
            'total_comments' => count($comments)
        ]);

    }


    function getTotalLikesReceived($user_id) {
            
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


    function getOwnPosts($user_id) {

        // Find the user
        $existing_volunteer_user = volunteer_user::find($user_id);
    
        if (!$existing_volunteer_user) {
            return response()->json(
                ['status' => 'error', 
                'message' => 'User not found'
            ]);
        }
    
        // Get the user's posts 
        $posts = Post::where('user_id', $user_id)->orderBy('post_date', 'desc')->get();
    
        // If the user did not post anything
        if ($posts->isEmpty()) {
            return response()->json([
                'message' => 'No posts found for this user'
            ]);
        }
    
        // Remove the fields we don't want to return
        foreach ($posts as $post) {
            unset($post->field1, $post->field2, $post->created_at, $post->updated_at);
        }

        foreach ($posts as $post) {
            $post->full_name = volunteer_user::find($post->user_id)->first_name . " " . volunteer_user::find($post->user_id)->last_name;
        }
        
    
        // Return the posts
        return response()->json([
            'posts' => $posts,

        ]);
    
    }      


    function editProfile(Request $request) {

        // Get the user_id from the request
        $user_id = $request->user_id;

        // Find the authenticated user
        $existing_volunteer_user = volunteer_user::find($user_id);
    
        // Check if the user exists in the database
        if (!$existing_volunteer_user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'],);
        }
    
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'user_profile_pic' => 'nullable',
            'username' => 'nullable|string|max:255|unique:volunteer_users,username,' . $existing_volunteer_user->id,
            'user_bio' => 'nullable|string|max:500',
        ]);
    
        // If validation fails, return a response with errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()]);
        }
    
        if($request->hasFile('user_profile_pic')){
            $request->validate([
                'user_profile_pic' => 'mimes:jpeg,bmp,png,jpg'
            ]);

            $request->user_profile_pic->store('public/images');
            $existing_volunteer_user->user_profile_pic = $request->user_profile_pic->hashName();
        }
    
        // Update the user's username if it was provided
        if ($request->has('username')) {
            $existing_volunteer_user->username = $request->input('username');
        }
    
        // Update the user's bio if it was provided
        if ($request->has('user_bio')) {
            $existing_volunteer_user->user_bio = $request->input('user_bio');
        }
    
        // Save the user's changes to the database
        $existing_volunteer_user->save();
    
        // Return a success response
        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
        'new_pic' => $existing_volunteer_user->user_profile_pic
    ]);

    }
    
    // get the user's branch info by matching the users branch id and the branch id in the branch table
    function getBranchInfo($user_id) {

        $existing_user = volunteer_user::find($user_id);

        // If user is not found
        if (!$existing_user) {
            return response()->json(
                ['status' => 'error', 
                'message' => 'User not found'
            ]);
        }
        
        $branch = branch::where('id', $existing_user->branch_id)->first();

        // If branch is not found
        if (!$branch) {
            return response()->json(
                ['status' => 'error', 
                'message' => 'Branch not found'
            ]);
        }

        // Return the branch name and location
        return response()->json([
            'branch_name' => $branch->branch_name,
            'branch_location' => $branch->branch_location
        ]);


       
    }
    

 }
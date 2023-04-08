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


class UserController extends Controller
{


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

        ], $existing_volunteer_user ? 200 : 404);

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


    function get_user_info($user_id) {
            
            // Find the user
            $existing_volunteer_user = volunteer_user::find($user_id);
    
            if (!$existing_volunteer_user) {
                return response()->json(['status' => 'error', 
                'message' => 'User not found'
            ]);
            }
    
            // Get the user's information
            $user_info = volunteer_user::where('id', '=', $user_id)->first();
            

            // Remove the password from the user's information
            unset($user_info->password);

            // Return the user's information
            return response()->json(['status' => 'success', 
            'message' => $user_info
        ]);
    
    }
    
    
    function get_total_trainings($user_id) {
        
        // Find the user
        $existing_volunteer_user = volunteer_user::find($user_id);
        
        if (!$existing_volunteer_user) {
            return response()->json(['status' => 'error', 
            'message' => 'User not found'
        ]);
        }
        
        // Get the total number of trainings
        $total_trainings = take::where('user_id', '=', $user_id)->count();
        
        // Return the total number of trainings
        return response()->json([ 
            'total trainings' => $total_trainings
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

    function get_total_posts($user_id) {

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

    function get_total_comments($user_id) {

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

    function get_total_events_organized($user_id) {
            
            // Find the user
            $existing_volunteer_user = volunteer_user::find($user_id);
    
            if (!$existing_volunteer_user) {
                return response()->json(
                    ['status' => 'error', 
                    'message' => 'User not found'
                ]);
            }
    
            // Get the user's events
            $events = is_responsible::where('user_id', $user_id)->get();
    
            // If the user did not organize any events
            if ($events->isEmpty()) {
                return response()->json([
                    'message' => 'No events found for this user'
                ]);
            }
    
            // Return the total count of events
            return response()->json([
                'total_events_organized' => count($events)
            ]);
    

    }

    function get_total_trainings_yah($user_id) {

        // Find the user
        $existing_volunteer_user = volunteer_user::find($user_id);

        if (!$existing_volunteer_user) {
            return response()->json(
                ['status' => 'error', 
                'message' => 'User not found'
            ]);
        }

        // get the IDs of all youth and health trainings
        $yah_training_ids = Training::where('program_id', 1)->pluck('id')->toArray();

        // get the IDs of all trainings the user has taken
        $user_training_ids = take::where('user_id', $user_id)->pluck('training_id')->toArray();

        // get the IDs of all trainings the user has taken that are youth and health trainings
        $yah_training_ids = array_intersect($yah_training_ids, $user_training_ids);

        // get the total count of youth and health trainings the user has taken
        $total_trainings_yah = count($yah_training_ids);

        return response()->json([
            'total_trainings_yah' => $total_trainings_yah
        ]);


    }

    function get_total_trainings_hvp($user_id) {

        // Find the user
        $existing_volunteer_user = volunteer_user::find($user_id);

        if (!$existing_volunteer_user) {
            return response()->json(
                ['status' => 'error', 
                'message' => 'User not found'
            ]);
        }

        // get the IDs of all human values and principles trainings
        $hvp_training_ids = training::where('program_id', 2)->pluck('id')->toArray();

        // get the IDs of all trainings the user has taken
        $user_training_ids = take::where('user_id', $user_id)->pluck('training_id')->toArray();

        // get the IDs of all trainings the user has taken that are human values and principles trainings
        $hvp_training_ids = array_intersect($hvp_training_ids, $user_training_ids);

        // get the total count of human values and principles trainings the user has taken
        $total_trainings_hvp = count($hvp_training_ids);

        return response()->json([
            'total_trainings_hvp' => $total_trainings_hvp
        ]);


    }

    function get_total_trainings_env($user_id) {

        // Find the user
        $existing_volunteer_user = volunteer_user::find($user_id);

        if (!$existing_volunteer_user) {
            return response()->json(
                ['status' => 'error', 
                'message' => 'User not found'
            ]);
        }

        // get the IDs of all environment trainings
        $env_training_ids = training::where('program_id', 3)->pluck('id')->toArray();

        // get the IDs of all trainings the user has taken
        $user_training_ids = take::where('user_id', $user_id)->pluck('training_id')->toArray();

        // get the IDs of all trainings the user has taken that are environment trainings
        $env_training_ids = array_intersect($env_training_ids, $user_training_ids);

        // get the total count of environment trainings the user has taken
        $total_trainings_env = count($env_training_ids);

        return response()->json([
            'total_trainings_env' => $total_trainings_env
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


    

}

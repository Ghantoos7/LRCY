<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\volunteer_user;
use App\Models\recover_request;
use App\Models\take;
use App\Models\training;

class UserController extends Controller
{


    function signup(Request $request) {

        // Get the organization ID from the request
        $organization_id = $request->input('organization_id');

        // Retrieve a volunteer user record from the database based on the `organization_id` input parameter
        $existing_volunteer_user = volunteer_user::where('organization_id', '=', $organization_id)->first();
        
        // Determine the status message based on the existence and registration status of the volunteer user
        $status = $existing_volunteer_user ? ($existing_volunteer_user->is_registered ? 'Organization ID found, user already registered' : 'Organization ID found, user not registered') : 'Organization ID not found';
        
        // Return a JSON response with the status message and appropriate HTTP status code
        return response()->json([

            'status' => $status

        ], $existing_volunteer_user ? 200 : 404);

    }


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
            ], 400);
        }
    
        // Validate the password using the validatePassword() function
        $password_errors = $this->validatePassword($request->input('password'));
    
        if (!empty($password_errors)) {
            $status = 'Invalid password: ' . implode(', ', $password_errors);
    
            return response()->json([
                'status' => $status,
            ], 400);
        }
    
        // Retrieve a volunteer user record from the database based on the `organization_id` input parameter
        $existing_volunteer_user = volunteer_user::where('organization_id', '=', $request->input('organization_id'))->first();
    
        // Check if the volunteer user exists in the database
        if (!$existing_volunteer_user) {
            return response()->json([
                'status' => 'Organization ID not found',
            ], 404);
        }
    
        // Check if the volunteer user is already registered
        if ($existing_volunteer_user->is_registered) {
            return response()->json([
                'status' => 'Organization ID found, user already registered',
            ], 200);
        }
    
        // Set the is_registered, username and password attributes of the user object and save it to the database
        $existing_volunteer_user->is_registered = 1;
        $existing_volunteer_user->username = $request->input('username');
        $existing_volunteer_user->password = Hash::make($request->input('password'));
        $existing_volunteer_user->save();
    
        // Return a JSON response with the appropriate status message and HTTP status code
        return response()->json([
            'status' => 'Organization ID found, user registered successfully',
        ], 200);

    }
    

    function login(Request $credentials) {

        // Find user by organization ID
        $existing_volunteer_user = volunteer_user::where("organization_id", "=", $credentials->organization_id)->first();
    
        // Determine the status message based on the existence and registration status of the volunteer user
        $status = (!$existing_volunteer_user) ? "Organization ID not found" : (!$existing_volunteer_user->is_registered ? "Organization ID found, user not registered" : (!Hash::check($credentials->password, $existing_volunteer_user->password) ? "Wrong Password" : $existing_volunteer_user));
    
        // Return response with status of login attempt
        return response()->json(['status' => $status]);
    
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


    function get_user_info(Request $request, $user_id = null) {

        // Retrieve the user information from the database
        $users = $user_id ? [volunteer_user::find($user_id)] : volunteer_user::all();
    
        // If no user(s) found, return a 404 response
        if (count($users) === 0 || $users[0] === null) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
    
        // Remove password field from user(s) information
        $usersArray = array_map(function($user) {
            unset($user['password']);
            return $user;
        }, collect($users)->toArray());
    
        // Return the user(s) information
        return response()->json($user_id ? ['user' => $usersArray[0]] : ['users' => $usersArray]);

    }
    
    
    function get_total_trainings(Request $request, $user_id) {

        // Get the user's takes
        $user_takes = Take::where('user_id', $user_id)->get();
    
        // Get the training IDs of the user's takes
        $training_ids = $user_takes->pluck('training_id')->toArray();
    
        // Get the trainings with the matching IDs
        $trainings = Training::whereIn('id', $training_ids)->select('id', 'training_name', 'training_description', 'program_id')->get();
    
        // If no trainings are found for the user, return a 404 response
        if ($trainings->isEmpty()) {
            return response()->json([
                'message' => 'No trainings found for this user'
            ], 404);
        }
    
        // Remove any fields that are not needed
        $trainingsArray = $trainings->map(function ($training) {
            return [
                'id' => $training->id,
                'training_name' => $training->training_name,
                'training_description' => $training->training_description,
                'program_id' => $training->program_id
            ];
        });
    
        // Return the total count of trainings and the trainings themselves
        return response()->json([
            'total_trainings' => count($trainingsArray),
            'trainings' => $trainingsArray,
        ]);

    }
    

}

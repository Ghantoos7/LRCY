<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\volunteer_user;
use App\Models\recover_request;
use App\Models\login_attempt;

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
        
        return $existing_volunteer_user ? (!$existing_request ? ((new recover_request(['user_id' => $existing_volunteer_user->id, 'request_status' => false, 'request_date' => $request_date]))->save() ? response()->json(['status' => 'Password recovery request sent successfully']) : response()->json(['status' => 'Failed to create password recovery request'])) : response()->json(['status' => 'User has already submitted a request.'])) : response()->json(['status' => 'Organization ID not found']);
   
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

        // If the user does not exist, return an error response. Otherwise, update the password and return a success response
        if ($existing_volunteer_user) {
            $existing_volunteer_user->password = Hash::make($request->input('password'));
            $saveResult = $existing_volunteer_user->save();
            return response()->json($saveResult ? ['status' => 'success', 'message' => 'Password changed successfully'] : ['status' => 'error', 'message' => 'Failed to update password']);
        } 
        else {
            return response()->json(['status' => 'error', 'message' => 'Organization ID not found']);
        }
         
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
    
    
    
    
    
    

}

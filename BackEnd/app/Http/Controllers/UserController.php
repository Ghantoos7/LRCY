<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\volunteer_user;


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
    
    

    
    
    

}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\volunteer_user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\login_attempt;
use App\Models\Branch;

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


    function admin_login(Request $request) {

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


    function add_user(Request $request) {
        
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
                'date_of_birth' => $request->input('date_of_birth'),
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
    

    function edit_user(Request $request) {

        try {
            $user = Volunteer_user::where('id', $request->input('user_id'))->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
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

    
    function delete_user(Request $request) {
        try {
            $user = Volunteer_user::where('id', $request->input('user_id'))->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
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

}

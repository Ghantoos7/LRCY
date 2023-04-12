<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\volunteer_user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\login_attempt;

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


    function admin_login(Request $credentials) {
        
        $check_user = volunteer_user::where("organization_id", $credentials->organization_id)->first();

        // Validates the request
        $credentials->validate([
            "organization_id" => "required",
            "password" => "required",
        ]);

        // Checks if the user exists in the database
        if(!$check_user) {
            return response()->json([
                "status" => "User not found",
            ]);
        }
    
        // Checks if the user is an admin (user_type_id = 1)
        if($check_user->user_type_id != 1){
            return response()->json([
                "status" => "Permission denied",
            ]);
        }

        // Checks if the password is valid
        $errors = $this->validatePassword($credentials->password);
        if (count($errors) > 0) {
            return response()->json([
                "status" => $errors,
            ]);
        }

        // Checks if the user has exceeded the maximum number of login attempts
        if ($this->hasExceededLoginAttempts($credentials->organization_id)) {
            return response()->json([
                "status" => "Too many failed login attempts",
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
                "status" => $check_user
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


}

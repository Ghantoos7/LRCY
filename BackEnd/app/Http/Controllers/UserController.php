<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\volunteer_user;

class UserController extends Controller
{



    function signup(Request $request) {
        $organization_id = $request->input('organization_id');
        $existing_volunteer_user = volunteer_user::where('organization_id', '=', $organization_id)->first();
        if($existing_volunteer_user) {
            if($existing_volunteer_user->is_registered == 0) {
                return response()->json([
                    'status' => 'Organization ID found, user not registered'
                ]);
            }
            else {
                return response()->json([
                    'status' => 'Organization ID found, user already registered'
                ]);
            }
        }
        else {
            return response()->json([
                'status' => 'Organization ID not found'
            ]);
        }
    }

   

    
}

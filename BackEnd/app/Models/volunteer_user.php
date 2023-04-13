<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class volunteer_user extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'first_name', 
        'last_name',
        'username',
        'organization_id', 
        'user_type_id', 
        'user_dob', 
        'password', 
        'is_active', 
        'is_registered', 
        'is_active', 
        'user_position',
        'gender',
        'branch_id',
        'user_start_date',
        'user_age',
        'user_profile_pic',
        'user_start_date',
        'user_end_date',
        'user_bio'
    ];

}

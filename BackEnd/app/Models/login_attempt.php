<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class login_attempt extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'organization_id', 
        'login_attempt_time', 
        'login_attempt_date'
    ];
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class goal extends Model
{

    use HasFactory;

    protected $fillable = [
        'goal_name',
        'goal_description',
        'program_id',
        'goal_status',
        'number_to_complete',
        'number_completed',
        'goal_year',
        'event_type_id',
        'goal_deadline',
        'start_date',
        'branch_id'
    ];

}

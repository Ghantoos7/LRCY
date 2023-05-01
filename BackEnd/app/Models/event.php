<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{

    use HasFactory;

    protected $fillable = [
        'event_main_picture',
        'event_description',
        'event_location',
        'event_date',
        'event_title',
        'event_type_id',
        'program_id',
        'budget_sheet',
        'proposal',
        'meeting_minute',
        'branch_id',
    ];

}

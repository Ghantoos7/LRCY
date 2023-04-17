<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event_image extends Model
{

    use HasFactory;

    protected $fillable = [
        'event_image_source',
        'event_id'
    ];

}

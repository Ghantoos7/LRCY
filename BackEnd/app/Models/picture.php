<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class picture extends Model
{

    use HasFactory;

    protected $fillable = [
        'picture',
        'event_id'
    ];

}

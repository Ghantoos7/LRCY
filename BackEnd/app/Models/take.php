<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class take extends Model
{

    use HasFactory;

    protected $fillable = [
        'takes_on_date',
        'training_id',
        'user_id'
    ];

}

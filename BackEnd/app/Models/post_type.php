<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post_type extends Model
{

    use HasFactory;

    protected $fillable = [
        'post_type_name'
    ];

}

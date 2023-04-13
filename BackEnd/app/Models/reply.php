<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reply extends Model
{

    use HasFactory;

    protected $fillable = [
        'comment_id', 
        'user_id', 
        'reply_content', 
        'reply_date'
    ];

}

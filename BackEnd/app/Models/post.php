<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id', 
        'post_type_id', 
        'post_caption', 
        'post_media', 
        'comment_count', 
        'like_count', 
        'post_date'
    ];
    
}

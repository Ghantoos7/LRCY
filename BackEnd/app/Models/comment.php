<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'user_id', 'comment_content', 'comment_date', 'comment_like_count', 'comment_reply_count'];
}

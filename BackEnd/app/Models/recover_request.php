<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recover_request extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'request_status', 'request_date', 'field1', 'field2'];
}

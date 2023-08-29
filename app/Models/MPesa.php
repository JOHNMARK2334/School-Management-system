<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPesa extends Model
{
    use HasFactory;
    protected $fillable=['user_id','course_id','student_id','reference','phone_number','amount','description','attempts','is_initiated','queued_at'];
}

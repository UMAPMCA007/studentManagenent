<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'course_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function course($course_id)
    {
        $course = Course::find($course_id);
        return $course->course;
    }
    


}

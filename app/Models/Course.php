<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course', 'description',  'reg_end',
    ];

    public function applied_courses()
    {
        return $this->hasMany('App\Models\AppliedCourse');
    }
}

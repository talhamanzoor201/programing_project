<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HireRequest extends Model
{

    public function days()
    {
        return $this->hasMany(RequestDays::class, 'hire_request_id', 'id');
    }

    public function courses()
    {
        return $this->belongsToMany(SubCourse::class, 'request_courses', 'hire_request_id', 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id', 'id');
    }

}

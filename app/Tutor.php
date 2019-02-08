<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{

    /**
     * tutor course name
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function profile()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subCourses()
    {
        return $this->belongsToMany(SubCourse::class, 'tutor_has_courses', 'tutor_id', 'subCourse_id');
    }

    public function requests()
    {
        return $this->hasMany(HireRequest::class, 'tutor_id', 'id');
    }

    public function reports()
    {
        return $this->hasMany(StudentProgress::class, 'tutor_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'tutor_id', 'id');
    }
}

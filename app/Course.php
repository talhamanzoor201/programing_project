<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    public function subCourses()
    {
        return $this->hasMany(SubCourse::class, 'course_id', 'id');
    }

    public function tutors()
    {
        return $this->hasMany(Tutor::class, 'course_id', 'id');
    }

    public function tutorCount($id)
    {
        return Tutor::where('course_id', $id)->whereHas('profile', function ($q) {
            $q->where('status', 'active');
        })->count();
    }
}

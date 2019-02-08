<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentProgress extends Model
{


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(SubCourse::class, 'course_id', 'id');
    }
    public function parent_child()
    {
        return $this->belongsTo(Children::class, 'parent_child_id', 'id');
    }
}

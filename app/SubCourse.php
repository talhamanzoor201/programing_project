<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCourse extends Model
{

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }
}

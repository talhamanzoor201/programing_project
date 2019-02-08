<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestDays extends Model
{
    protected $fillable = [
      'day','hire_request_id'
    ];
}

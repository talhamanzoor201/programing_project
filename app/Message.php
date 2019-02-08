<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'is_read', 'friend_id'
    ];

    public function getCreatedAtAttribute($value)
    {
        $dt = Carbon::parse($value);

        $time = Carbon::createFromFormat('Y-m-d H:i:s', $dt)->diffForHumans(null, null, true);
        return $time;

    }
}

<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Tutor profile
     */
    public function tutor()
    {
        return $this->hasOne(Tutor::class, 'user_id', 'id');
    }

    /**
     * Student profile
     */
    public function student()
    {
        return $this->hasOne(Student::class, 'user_id', 'id');
    }

    /**
     * user city name get
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function requests()
    {
        return $this->hasMany(HireRequest::class, 'user_id', 'id');
    }

    public function reports()
    {
        return $this->hasMany(StudentProgress::class, 'user_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }

    public function conversationMine()
    {
        return $this->belongsToMany(User::class, 'conversations', 'user_id', 'friend_id');
    }

    public function conversationFriend()
    {
        return $this->belongsToMany(User::class, 'conversations', 'friend_id', 'user_id');
    }

    public function conversations()
    {
        return $this->conversationMine->merge($this->conversationFriend);
    }

    //parent has many children
    public function childrens()
    {
        return $this->hasMany(Children::class, 'user_id', 'id');
    }

    // check if user is online

    public function isOnline()
    {
        return $this->hasOne(OnlineUser::class, 'user_id', 'id');
    }
}

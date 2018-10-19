<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * Get the comments from the user.
     */
    public function myRatings()
    {
        return $this->hasMany('App\Rating', 'from_user_id', 'id');
    }
    /**
     * Get the comments for to user.
     */
    public function ratingsToMe()
    {
        return $this->hasMany('App\Rating', 'to_user_id', 'id');
    }

}

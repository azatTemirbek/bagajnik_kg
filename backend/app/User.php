<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'surname',
        'name',
        'phone',
        'email',
        'password',
        'provider',
        'provider_id',
        'photo'
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
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

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
    /**
     * get avarage rating
     */
    public function avarageRating()
    {
        return $this->ratingsToMe()->avg('rate_value');
    }

    public function sentLuggaeges()
    {
        return $this->offersToMe();
    }

    /**
     * Get all the trips.
     */
    public function trips()
    {
        return $this->hasMany('App\Trip', 'carrier_id', 'id');
    }

    /**
     * Get all the trips.
     */
    public function luggages()
    {
        return $this->hasMany('App\Luggage', 'owner_id', 'id');
    }

    /**
     * Get my offers list.
     */
    public function myOffers()
    {
        return $this->hasMany('App\Offer', 'req_user_id', 'id');
    }

    /**
     * Get offers to me
     */
    public function offersToMe()
    {
        return $this->hasMany('App\Offer', 'res_user_id', 'id');
    }

    /**
     * Crypto the password.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}

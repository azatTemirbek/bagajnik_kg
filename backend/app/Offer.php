<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    /**
     * Get the Luggage that owns the offer.
     */
    public function luggage()
    {
        return $this->belongsTo('App\Luggage', 'luggage_id');

    }
    /**
     * Get the Trip that owns the offer.
     */
    public function trip()
    {
        return $this->belongsTo('App\Trip', 'trip_id');
    }
    /**
     * Get the User that owns the offer.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'req_user_id');
    }
}


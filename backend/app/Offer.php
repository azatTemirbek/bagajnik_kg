<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'req_user_id',
        'res_user_id',
        'luggage_id',
        'trip_id',
        'agree',
        'status',
    ];

    /**
     * Get the LuggageResource that owns the offer.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function luggage()
    {
        return $this->belongsTo('App\Luggage', 'luggage_id');
    }

    /**
     * Get the TripsResource that owns the offer.
     */
    public function trip()
    {
        return $this->belongsTo('App\Trip', 'trip_id');
    }

    /**
     * Get the User that owns the offer.
     */
    public function req_user()
    {
        return $this->belongsTo('App\User', 'req_user_id','id');
    }

    /**
     * user to whome the offer was targeted
     */
    public function res_user()
    {
        return $this->belongsTo('App\User', 'res_user_id','id');
    }
}


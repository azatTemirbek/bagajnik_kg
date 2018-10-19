<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    /**
     * Get user who is bag carrier
     */
    public function carrier() {
        return $this->belongsTo('App\User','carrier_id');
    }
    /**
     * Get all the offers.
     */
    public function offers()
    {
        return $this->hasMany('App\Offer', 'trip_id', 'id');
    }
}

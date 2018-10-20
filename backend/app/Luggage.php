<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Luggage extends Model
{
    /**
     * Get owner of the luggage
     */
    public function owner() {
        return $this->belongsTo('App\User','owner_id');
    }
    /**
     * Get all the offers.
     */
    public function offers()
    {
        return $this->hasMany('App\Offer', 'luggage_id', 'id');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'start_dt',
        'end_dt',
        'from',
        'to',
    ];
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

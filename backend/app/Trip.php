<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'carrier_id',
        'start_dt',
        'end_dt',
        'from_lat',
        'from_lng',
        'from_formatted_address',
        'from_place_id',
        'to_lat',
        'to_lng',
        'to_formatted_address',
        'to_place_id',
    ];

    /**
     * Get user who is bag carrier
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
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

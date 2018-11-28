<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'carrier_id',
        'start_dt',
        'end_dt',
        'from_formatted_address',
        'to_formatted_address',
    ];
    /**
     * used to make fielad datetime
     * @var array
     */
    protected $dates = [
        'start_dt',
        'end_dt',
    ];

    /**
     * Get user who is bag carrier
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carrier()
    {
        return $this->belongsTo('App\User', 'carrier_id');
    }

    /**
     * Get all the offers.
     */
    public function offers()
    {
        return $this->hasMany('App\Offer', 'trip_id', 'id');
    }
}

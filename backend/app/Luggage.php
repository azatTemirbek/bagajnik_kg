<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Luggage extends Model
{
    protected $fillable = [
        'owner_id',
        'takerPhone1',
        'takerPhone2',
        'takerName',
        'comertial',
        'start_dt',
        'end_dt',
        'value',
        'price',
        'from_formatted_address',
        'to_formatted_address',
        'mass',
        'dsc'
    ];
    protected $dates = [
        'start_dt',
        'end_dt',
    ];

    /**
     * Get owner of the luggage
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

    /**
     * Get all the offers.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers()
    {
        return $this->hasMany('App\Offer', 'luggage_id', 'id');
    }
}

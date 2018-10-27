<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Luggage extends Model
{
    protected $fillable = [
        'takerName',
        'takerPhone1',
        'takerPhone2',
        'mass',
        'comertial',
        'value',
        'price',
        'from',
        'to',
        'start_dt',
        'end_dt',
    ];
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
<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Luggage extends Model
{
    protected $fillable = [
        'takerPhone1',
        'takerPhone2',
        'takerName',
        'comertial',
        'start_dt',
        'end_dt',
        'value',
        'price',
        'from',
        'mass',
        'to',
    ];
    /**
     * Get owner of the luggage
     */

    public function to() {
        return $this->belongsTo('App\Address','id');
    }
    public function from() {
        return $this->belongsTo('App\Address','id');
    }

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
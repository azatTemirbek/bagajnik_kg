<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'rate_value',
        'comment',
    ];
    /**
     * Get the User that owns the comment.
     */
    public function from_user()
    {
        return $this->belongsTo('App\User', 'from_user_id');
    }
    public function to_user()
    {
        return $this->belongsTo('App\User', 'to_user_id');
    }
}

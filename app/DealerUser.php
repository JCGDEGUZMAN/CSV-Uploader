<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerUser extends Model
{
            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'dealer_id', 'is_dealer'
    ];
}

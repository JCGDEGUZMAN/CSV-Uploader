<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributorDealer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'distributor_id', 'dealer_id'
    ];
}

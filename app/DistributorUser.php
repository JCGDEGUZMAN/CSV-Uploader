<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributorUser extends Model
{
    protected $fillable = [
        'user_id', 'distributor_id', 'is_distributor'
    ];
}

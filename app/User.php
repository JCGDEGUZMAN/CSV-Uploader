<?php

namespace App;

use App\Imports\AdminUsersImport;
use App\Imports\DistributorUsersImport;
use App\Imports\DistributorOwnerImport;
use App\Imports\DealerOwnerImport;
use App\Imports\DealerUsersImport;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Maatwebsite\Excel\Facades\Excel;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'email', 'mobile_number', 'password', 'group', 'access',  
        'street', 'barangay', 'city', 'province', 'zone', 'region', 'zip_code', 'photo', 'sales_coordinator', 'capacity',
        'is_owner',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function importAdminUsers($file)
    {
        Excel::import(new AdminUsersImport,$file);
           
        return redirect()->back()->with('message', 'Import Successful!');
    }
}

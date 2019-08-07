<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class DistributorOwnerImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'group'                 => 2,
            'first_name'            => $row['first_name'],
            'middle_name'           => $row['middle_name'],
            'last_name'             => $row['last_name'],
            'access'                => $row['access'],
            'email'                 => $row['email'],
            'mobile_number'         => $row['mobile_number'],
            'password'              => Hash::make($row['password']),
            'is_owner'              => true,
        ]);
    }
}

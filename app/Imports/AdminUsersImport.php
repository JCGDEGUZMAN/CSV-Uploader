<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdminUsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'first_name'            => $row['first_name'],
            'middle_name'           => $row['middle_name'],
            'last_name'             => $row['last_name'],
            'group'                 => 1,
            'access'                => $row['access'],
            'email'                 => $row['email'],
            'mobile_number'         => $row['mobile_number'],
            'password'              => Hash::make($row['password']),
        ]);
    }
}

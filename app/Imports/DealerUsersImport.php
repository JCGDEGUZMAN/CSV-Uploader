<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DealerUsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'group'                 => 3,
            'access'                => $row['access'],
            'street'                => $row['street'],
            'barangay'              => $row['barangay'],
            'city'                  => $row['city'],
            'province'              => $row['province'],
            'zone'                  => $row['zone'],
            'region'                => $row['region'],
            'zip_code'              => $row['zip_code'],
            'sales_coordinator'     => $row['sales_coordinator'],
            'capacity'              => $row['capacity'],
        ]);
    }
}

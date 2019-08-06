<?php

namespace App\Imports;

use App\Products;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Products([
            'product_number'        => $row['product_number'],
            'product_name'          => $row['product_name'],
            'product_description'   => $row['product_description'],
            'category'              => $row['category'],
            'unit'                  => $row['unit'],
            'weight'                => $row['weight'],
            'size'                  => $row['size'],
            'price'                 => $row['price'],
            'srp'                   => $row['srp'],
        ]);
    }
}

<?php

namespace App;

use App\Imports\ProductsImport;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;

class Products extends Model
{
    protected $fillable = [
        'product_number', 'product_name', 'product_description', 'category', 'photo', 'unit', 'weight', 'size', 'price', 'srp', 'is_vatable,'
    ];

    public static function importProducts($file)
    {
        Excel::import(new ProductsImport,$file);
           
        return redirect()->back()->with('message', 'Import Successful!');
    }
}

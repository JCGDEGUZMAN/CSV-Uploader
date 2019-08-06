<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function urcImportView()
    {
        return view('import');
    }

    public function importProducts()
    {
        return Products::importProducts(request()->file('product_file'));
    }
}

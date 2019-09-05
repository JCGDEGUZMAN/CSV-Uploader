<?php
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){
    return view('import');
});

Route::post('importProducts', 'ProductController@importProducts')->name('importProducts');
Route::post('importAdminUsers', 'UserController@importAdminUsers')->name('importAdminUsers');
Route::post('importDistributors', 'UserController@importDistributors')->name('importDistributors');
Route::post('importDealers', 'UserController@importDealers')->name('importDealers');

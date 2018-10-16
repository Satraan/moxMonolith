<?php

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

Route::get('/', function () {
    $products = App\Product::all();
    return View::make('wishlist', compact('products'));
//    return view('wishlist' , );
});

Route::get('/stock', 'TestController@stock');

Route::get('/list', 'WishlistController@list');

Route::get('/deleteCard/{card}', 'WishlistController@removeFromWishlist');



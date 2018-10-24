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

Route::get('/logout', 'HomeController@logout');

Route::get('/deleteCard/{card}', 'WishlistController@removeFromWishlist');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//User Pages
Route::get('/user/dashboard', function () {return view('/user/dashboard');});
Route::get('/user/wishlist', function () {return view('/user/wishlist');});
Route::get('/user/alerts', function () {return view('/user/alerts');});
Route::get('/user/settings', function () {
    return view('/user/settings');});

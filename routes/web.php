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
Route::get('/email', function () {
    return view('email');
});

Route::get('/logout', 'HomeController@logout');

//Wishlist
Route::post('/createWishlist', 'WishlistController@createWishlist');
Route::get('/deleteCard/{wishlist}/{card}', 'WishlistController@removeFromWishlist');
Route::get('/deleteWishlist/{wishlist}', 'WishlistController@deleteWishlist');
Route::get('/user/wishlist/view/{wishlist}', 'WishlistController@view');
Route::post('/addToWishlist', 'WishlistController@addToWishlist');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//User Pages
Route::get('/user/dashboard', function () {return view('/user/dashboard');});

Route::get('/user/alerts', function () {return view('/user/alerts');});
Route::get('/user/settings', function () {
    return view('/user/settings');});

Route::get('/user/wishlist/', 'WishlistController@list');

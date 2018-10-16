<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


https://api.scryfall.com
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/addToWishlist', 'TestController@add');



Route::get('/scrapeTopDeck', 'ScrapingController@scrapeTopDeck');
Route::get('/scrapeDracoti', 'ScrapingController@scrapeDracoti');
Route::get('/scrapeSadRobot', 'ScrapingController@scrapeSadRobot');
Route::get('/scrapeUnderworldConnections', 'ScrapingController@scrapeUnderworldConnections');
Route::get('/scrapeGeekhome', 'ScrapingController@scrapeGeekhome');
//Route::get('/scrapeAll', 'ScrapingController@scrapeAll');

Route::get('/testApi', function (){

    $request = new GuzzleHttp\Psr7\Request (
        "GET",
        "https://cloudproject-217611.appspot.com/api/cards"

    );

    $guzzle = new GuzzleHttp\Client();
    $result = $guzzle->send($request);

    return $result->getBody()->getContents();
});





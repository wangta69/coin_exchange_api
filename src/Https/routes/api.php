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
Route::group(['prefix' => 'api/coin-exchange', 'as' => 'api.coin-exchange.', 'namespace' => 'Pondol\CoinExchange', 'middleware' => ['api']], function () {
    Route::get('call/{exchanger}', 'CoinExchangeController@callApi')->name('call');//for test .. use post for security
    Route::post('call/{exchanger}', 'CoinExchangeController@callApi')->name('call');
});

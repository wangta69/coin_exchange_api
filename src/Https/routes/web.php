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
Route::group(['prefix' => 'coin-exchange', 'as' => 'coin-exchange.', 'namespace' => 'Pondol\CoinExchange'], function () {//, 'middleware' => ['web']
    Route::get('form/call', 'CoinExchangeFormController@callApi')->name('form.call');
    Route::post('form/call', 'CoinExchangeFormController@callApi')->name('form.call');
});

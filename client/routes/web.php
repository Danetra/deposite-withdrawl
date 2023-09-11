<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/auth', 'AuthController@index')->name('login');
Route::post('login', 'AuthController@login')->name('login.proses');
Route::get('logout', 'AuthController@destroy')->name('logout');

Route::group(['prefix' => 'wallet', 'middleware' => 'auth'], function () {
    Route::get('/', 'WalletController@index');
    Route::get('/deposite', 'WalletController@deposite');
    Route::get('/withdrawl', 'WalletController@withdrawl');
    Route::post('/depo', 'WalletController@createDepo');
    Route::post('/wd', 'WalletController@createWd');
    Route::get('/detail/{id}', 'WalletController@detail');
    Route::get('/delete/{id}', 'WalletController@delete');
});

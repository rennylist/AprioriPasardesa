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
    return view('dashboard'); 
})->name('dashboard');

Route::get('/transaction', 'TransactionController@index')->name('transaction');
Route::get('/apriori', 'AprioriController@index')->name('apriori');
Route::post('/processapriori', 'AprioriController@ProcessApriori')->name('processapriori');
Route::post('/transactionimport', 'TransactionController@import')->name('import');
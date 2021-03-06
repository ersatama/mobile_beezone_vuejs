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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/category', 'HomeController@category')->name('category');
Route::get('/cart','CartController@index')->name('cart');
Route::get('/checkout','CartController@checkout')->name('checkout');
Route::get('/cabinet','CabinetController@profile')->name('profile');

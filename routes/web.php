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
Route::get('/APIconfirmLogin','UserController@confirmLogin');//API to confirm log in, it is returning true (user is logged in) or false (user is nor logged in)
Route::post('/storeCoffeeDB','UserController@storeCoffee');// storing coffee if there is not any coffee already registered
Route::get('/userProfile', 'UserController@showUserView');//showing user Profile when a user logs in
Route::get('/APIGetCoffeeDB','CoffeeController@getCoffeeDB');//getting coffee from database and returning json to Coffeecollection vue
Route::get('/showCoffeeComments/{coffeeId}','CoffeeController@showCoffeeComment');

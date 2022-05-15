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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', 'Auth\Login\LoginController@login')->name('login');
Route::post('/login', 'Auth\Login\LoginController@login');

Route::get('/register', 'Auth\Register\RegisterController@register')->name('register');
Route::post('/register', 'Auth\Register\RegisterController@register');

Route::get('/confirmation', 'Auth\Register\RegisterController@confirmation')->name('confirmation');
Route::post('/confirmation', 'Auth\Register\RegisterController@confirmation');

Route::get('/storage', 'Auth\Register\RegisterController@storage');
Route::post('/storage', 'Auth\Register\RegisterController@storage');



Route::get('/add', 'Auth\Register\RegisterController@added')->name('add');
Route::post('/add', 'Auth\Register\RegisterController@added');

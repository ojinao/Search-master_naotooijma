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

Route::post('/confirmation', 'Auth\Register\RegisterController@confirmation');

Route::post('/storage', 'Auth\Register\RegisterController@storage');

Route::get('/add', 'Auth\Register\RegisterController@added')->name('add');

// login
Route::post('/logout','Auth\Login\LoginController@logout');

Route::get('/index','Auth\Post\PostController@index')->name('index');
Route::get('/search','Auth\Post\PostController@search')->name('search');

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

// Login routes
Route::get('/login', 'LoginController@login')->name('login');
Route::get('/', 'HomeController@index')->name('home');
Route::get('token_exchange', 'LoginController@token_exchange');

// Activity routes
Route::get('/activities', 'ActivityController@index');

//Schedule routes
Route::get('/schedule', 'ScheduleController@index')->name('schedule');;
Route::post('/schedule', 'ScheduleController@store');

//menu routes
Route::view('/menu', 'menu');
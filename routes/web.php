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
Route::get('login', 'LoginController@login')->name('login');
Route::get('logout', 'LoginController@logout')->name('logout');
Route::get('token_exchange', 'LoginController@token_exchange');

//ajax route

Route::get('chart/index','ActivityController@index');

// All routes you can only access when authenticated
Route::middleware('auth')->group(function () {
    //menu routes
    Route::view('/menu', 'menu');

    // Home
    Route::get('/', 'HomeController@index')->name('home');

    //Schedule routes
    Route::get('/schedule', 'ScheduleController@index')->name('schedule');;
    Route::post('/schedule', 'ScheduleController@store');

    // Activity routes
    Route::get('/activities', 'ActivityController@index');

});




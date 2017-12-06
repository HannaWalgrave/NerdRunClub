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

Route::get('hall-of-fame/{filter?}', 'FameController@index');

// All routes you can only access when authenticated
Route::middleware('auth')->group(function () {

    Route::get('/schedule/create', 'ScheduleController@create');

    Route::middleware('schedule')->group(function () {
        // Home
        Route::get('/', 'HomeController@index')->name('home');

        //Schedule routes
        Route::get('/schedule', 'ScheduleController@index');
        Route::get('/schedule/store', 'ScheduleController@store');
        Route::get('/deleteUserSchedule', 'ScheduleController@deleteUserSchedule');

        // Activity routes
        Route::get('/activities', 'ActivityController@index');
        Route::get('activities/chart', 'ActivityController@chart');

        //Dashboard routes
        Route::get('/dashboard', 'DashboardController@index');
        Route::get('/dashboard/chart', 'DashboardController@chart');
        Route::get('/dashboard/chartOne', 'DashboardController@chartOne');
    });
});




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

Route::middleware(['auth'])->group(function () {
    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::post('/users', 'UsersController@store')->name('users.store');
    Route::get('/profile', 'UsersController@show')->name('users.show');
    Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
    Route::put('/users/{id}', 'UsersController@update')->name('users.update');
    Route::delete('/users/{id}', 'UsersController@destroy')->name('users.destroy');
    Route::get('/users/search/{search?}/{direction?}/{sort?}', 'UsersController@search')->name('users.search');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/emails', 'EmailsController@index')->name('emails');
    Route::get('/emails/create', 'EmailsController@create')->name('emails.create');
    Route::post('/emails', 'EmailsController@store')->name('emails.store');
});

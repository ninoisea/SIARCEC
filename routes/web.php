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

Route::view('/', 'auth.login')->middleware('guest');
Route::view('/', 'home')->middleware('auth');

Route::resource('users', 'UsersController')->except(['edit', 'create']);
Route::post('users/restore/{id}', 'UsersController@restore');
Route::post('users/edit-password', 'UsersController@editPassword');

Route::resource('cheques', 'ChequesController');
Route::post('data-cheques', 'ChequesController@data');
Route::post('cheques/restore/{id}', 'ChequesController@restore');

Route::resource('imagenes', 'ImageController')->except(['edit', 'create']);

Auth::routes();

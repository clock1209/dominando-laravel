<?php

//DB::listen(function ($query) {
//    echo "<pre>{$query->sql}</pre>";
//});

Route::get('/', 'PageController@home')->name('home');

Route::get('saludos/{nombre?}', 'PageController@saludos')->name('saludos');

Route::resource('messages', 'MessageController');
Route::resource('users', 'UserController');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');

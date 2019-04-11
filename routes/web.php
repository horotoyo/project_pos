<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', 'AuthController@loginForm')->name('login');
Route::post('/login', 'AuthController@login')->name('login');
Route::post('/logout', 'AuthController@logout')->name('logout');

//index home admin
Route::get('/home', function() {
	return view('admin.home.index');
})->name('home.index');

Route::resource('/categories', 'CategoryController');
Route::resource('/products', 'ProductController');
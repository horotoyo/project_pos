<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', 'AuthController@loginForm')->name('login');
Route::post('/login', 'AuthController@login')->name('login');
Route::post('/logout', 'AuthController@logout')->name('logout');

//index home admin
Route::get('/home', 'HomeController@index')->name('home.index');

Route::resource('/categories', 'CategoryController');
Route::resource('/products', 'ProductController');
Route::resource('/payments', 'PaymentController');
Route::resource('/orders', 'OrderController');
Route::resource('/users', 'UserController');

Route::get('/reports', 'ReportController@index')->name('reports.index');
Route::post('/reports', 'ReportController@filter')->name('reports.filter');
Route::get('/reports/pdf', 'ReportController@exportPdf')->name('reports.pdf');
Route::post('/reports/pdf', 'ReportController@exportPdf')->name('reports.pdf');


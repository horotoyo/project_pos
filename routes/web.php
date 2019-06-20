<?php

//View form login
Route::get('/login', 'AuthController@loginForm')->name('login');
Route::post('/login', 'AuthController@login')->name('login');
Route::post('/logout', 'AuthController@logout')->name('logout');

Auth::routes();

//index home admin
Route::get('/home', 'HomeController@index')->name('home.index');

//yajra datatables setting
Route::get('/products/data', 'ProductController@data')->name('products.data');
Route::get('/categories/data', 'CategoryController@data')->name('categories.data');
Route::get('/orders/data', 'OrderController@data')->name('orders.data');
Route::get('/orders/{id}/print', 'OrderController@print')->name('orders.print');

//Resource main controller
Route::resource('/categories', 'CategoryController');
Route::resource('/products', 'ProductController');
Route::resource('/payments', 'PaymentController');
Route::resource('/orders', 'OrderController');
Route::resource('/users', 'UserController');

//Make report
Route::get('/reports', 'ReportController@index')->name('reports.index');
Route::post('/reports', 'ReportController@filter')->name('reports.filter');
Route::post('/reports/export', 'ReportController@export')->name('reports.export');

//login socialite
Route::get('socialauth/{provider}', 'SocialAuthController@redirectToProvider');
Route::get('socialauth/{provider}/callback', 'SocialAuthController@handleProviderCallback');

//sending email invoice
Route::post('/sendmail/{id}', 'SendMailController@sendMailInvoice')->name('send.mail');
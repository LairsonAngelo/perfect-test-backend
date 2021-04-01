<?php

use Illuminate\Support\Facades\Route;



/*
Telas para ver o funcionamento sem dados
*/
Route::get('/', 'DashboardController@index')->name('dashboard');

Route::get('/sales', function () {
    return view('crud_sales');
});
Route::resource('products','ProductsController');
Route::resource('sales','SalesController');


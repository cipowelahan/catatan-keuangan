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

Route::get('/', 'Home@index')->name('home');
Route::get('/main', 'Home@main');
Route::post('/error', 'Home@error');

Route::group(['prefix' => 'category'], function () {
    Route::get('/', 'Category@index');
    Route::match(['get', 'post'], '/create', 'Category@create');
    Route::match(['get', 'post'], '/edit', 'Category@update');
    Route::post('/delete', 'Category@delete');
});

Route::group(['prefix' => 'transaction'], function () {
    Route::get('/', 'Transaction@index');
    Route::get('/category', 'Transaction@category');
    Route::match(['get', 'post'], '/create', 'Transaction@create');
    Route::match(['get', 'post'], '/edit', 'Transaction@update');
    Route::post('/delete', 'Transaction@delete');
});
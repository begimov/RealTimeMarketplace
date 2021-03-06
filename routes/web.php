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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'webapi', 'namespace' => 'Webapi'], function () {

    Route::resource('products', 'Admin\ProductController');

    Route::resource('files', 'Admin\FileController');

    Route::resource('accounts', 'Admin\AccountController');

});

Route::group(['prefix' => 'webapi/catalog', 'namespace' => 'Webapi'], function () {

    Route::post('products/purchase', 'Catalog\ProductController@purchase')->middleware(['auth']);
    
    Route::post('products/sell', 'Catalog\ProductController@sell')->middleware(['auth']);

    Route::get('products', 'Catalog\ProductController@index');

});

Route::get('/categories/{category}', 'CategoryController@show')->name('categories.index');
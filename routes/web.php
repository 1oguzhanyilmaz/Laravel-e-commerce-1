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

Route::get('/','IndexController@index');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function () {
    Route::get('/', 'AdminController@index')->name('admin_home');
    /// Setting Area
    Route::get('/settings', 'AdminController@settings');
    Route::post('/update-pwd','AdminController@updatAdminPwd');
    /// Category Area
    Route::resource('/category','CategoryController');
    /// Products Area
    Route::resource('/product','ProductController');
    /// Product Attribute
    Route::resource('/product_attr','ProductAtrrController');
    Route::get('delete-attribute/{id}','ProductAtrrController@deleteAttr');
    /// Product Images Gallery
//    Route::resource('/image-gallery','ImagesController');
});


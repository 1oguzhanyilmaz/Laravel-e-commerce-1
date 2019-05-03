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
Route::get('/cat/{id}','IndexController@listByCat')->name('cats');
Route::get('/list-products','IndexController@listProducts');
Route::get('/product-detail/{id}','IndexController@detialpro');

### Cart ###
Route::post('/addToCart','CartController@addToCart')->name('addToCart');
Route::get('/viewcart','CartController@index');
Route::get('/cart/deleteItem/{id}','CartController@deleteItem');
Route::get('/cart/update-quantity/{id}/{quantity}','CartController@updateQuantity');
### Coupon Code ###
Route::post('/apply-coupon','CouponController@applycoupon');

### User and Register ###


### User Authenticate ###


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function () {
    Route::get('/', 'AdminController@index')->name('admin_home');
    ### Setting ###
    Route::get('/settings', 'AdminController@settings');
    Route::post('/update-pwd','AdminController@updatAdminPwd');
    ### Category ###
    Route::resource('/category','CategoryController');
    ### Products ###
    Route::resource('/product','ProductController');
    ### Product Attribute ###
    Route::resource('/product_attr','ProductAtrrController');
    Route::get('delete-attribute/{id}','ProductAtrrController@deleteAttr');
    ### Product Images Gallery ###
    Route::resource('/image-gallery','ImagesController');
    ### Coupons ###
    Route::resource('/coupon','CouponController');
});


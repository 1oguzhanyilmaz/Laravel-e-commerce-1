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
// Route::get('/list-products','IndexController@listProducts');
Route::post('/products-filter','IndexController@filterProducts');
Route::get('/product-detail/{id}','IndexController@detailpro');
Route::post('/ajaxStock', 'IndexController@ajaxStock');

### Cart ###
Route::post('/addToCart','CartController@addToCart')->name('addToCart');
Route::get('/viewcart','CartController@index');
Route::get('/cart/deleteItem/{id}','CartController@deleteItem');
Route::get('/cart/update-quantity/{id}/{quantity}','CartController@updateQuantity');
### Coupon Code ###
Route::post('/apply-coupon','CouponController@applycoupon');

### User and Register ###
Route::group(['middleware'=>'guest'], function (){
    Route::get('/login-page','UsersController@index');
    Route::post('/user-login','UsersController@login');
    Route::post('/user-register','UsersController@register');
});
Route::get('/logout','UsersController@logout');

### User Authenticate ###
Route::group(['middleware'=>'login_middleware'],function (){
    Route::get('/myaccount','UsersController@account');
    Route::put('/update-profile/{id}','UsersController@updateprofile');
    Route::put('/update-password/{id}','UsersController@updatepassword');
    Route::group(['middleware'=>'CheckCart'], function (){
        Route::get('/check-out','CheckOutController@index');
        Route::post('/submit-checkout','CheckOutController@submitcheckout');
        Route::get('/order-review','OrdersController@index');
        Route::post('/submit-order','OrdersController@order');
        Route::get('/cod','OrdersController@cod');
        Route::get('/paypal','OrdersController@paypal');
    });
});

//Auth::routes();
Auth::routes(['register'=>false]);
// Auth::routes(['register'=>false]);
// Auth::routes(['login'=>false]);
//Route::match(['get', 'post'], 'register', function(){
//    return redirect('/');
//});
//Route::match(['get', 'post'], 'login', function(){
//    return redirect('/');
//});

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
    ### Users - Dashboard ###
    Route::get('/users', 'UsersController@userIndex');
    Route::get('/users/create', 'UsersController@userCreate');
    Route::post('/users', 'UsersController@userStore');
    Route::get('/users/{id}', 'UsersController@userShow');
    Route::get('/users/{id}/edit', 'UsersController@userEdit');
    Route::put('/users/{id}', 'UsersController@userUpdate');
    Route::delete('/users/{id}', 'UsersController@userDestroy');
    ### Orders ###
    Route::get('/orders','OrdersController@getOrders');
    Route::post('/order/{id}','OrdersController@completeOrder');
});

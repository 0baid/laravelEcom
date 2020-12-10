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

Route::group(['as'=>'admin.', 'middleware' => ['auth','admin'], 'prefix' => 'admin'], function (){
    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::resource('product' , 'ProductController');
    Route::resource('category', 'CategoryController');
    Route::resource('profile', 'ProfileController');
    
});
 Route::group(['as' => 'products.', 'prefix' => 'products'],function(){
    Route::get('/' ,'ProductController@show')->name('all');
    Route::get('/{product}','ProductController@single')->name('single');
 });

Route::get('/search' , 'ProductController@search')->name('search');


Route::group(['as' => 'cart.' , 'prefix' =>'cart'],function(){
    Route::get('/show' , 'ProductController@showCart')->name('showCart');
    Route::get('/addProduct/{product}' , 'ProductController@addToCart')->name('add');
    Route::post('/removeFromCart/{product}' , 'ProductController@removeFromCart')->name('remove');
    Route::post('/updateCart/{product}', 'ProductController@updateCart')->name('update');
    Route::post('/checkout','CheckoutController@index')->name('checkout');
    Route::post('/checkout/confirmation','CheckoutController@store')->name('confirmation');

});

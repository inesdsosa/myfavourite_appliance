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

Route::get('/', 'WishlistController@index');

Route::post('addwishlist/{appliance}', 'WishlistController@addwishlist');
Route::post('delwishlist/{appliance}', 'WishlistController@delWishlist');

Route::get('my_wishlist', 'UsersController@myWishlist')->middleware('auth');
Route::post('share_mail/{email}', 'UsersController@share');

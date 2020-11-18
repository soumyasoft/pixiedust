<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('notify-paypal', 'CartController@updateTransactionDetails');
Route::get('banners', 'ApiController@getBanners');

Route::get('products', 'ApiController@getAllProducts');
Route::get('home-products', 'ApiController@getHomePageProducts');
Route::get('all-cat-subcat', 'ApiController@getAllCategorySubcategory');
Route::get('user-login', 'ApiController@userLogin');
Route::get('user-details', 'ApiController@fetchUserDetails');
Route::get('user-change-password', 'ApiController@userChangePassword');

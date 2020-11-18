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

//Route::get('/', function () {
//    return view('home');
//});

Route::get('/admin', function () {
    return view('admin.auth.login');
});
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

##### Admin Routes ####################

Route::group(['middleware' => 'disablepreventback'], function() {
    Auth::routes();
    Route::get('/admin/home', 'AdminController@index');
    Route::get('/admin/my-account', 'AdminController@showMyaccount');
    Route::post('/my-account', 'AdminController@updateMyaccount');
    Route::get('/admin/change-password', 'AdminController@showChangePassword');
    Route::post('/change-password', 'AdminController@changePassword');
    Route::resource('admin/banners', 'BannerController');
    Route::resource('admin/pages', 'CmsPageController');
    Route::resource('admin/product-categories', 'CategoryController');
    Route::resource('admin/product-subcategories', 'SubCategoryController');
    Route::get('/admin/newsletter', 'AdminController@getNewsLetter');
    Route::post('/send-newsletter', 'AdminController@sendNewsLetter');
    Route::resource('admin/products', 'ProductController');
    Route::resource('admin/coupon-code', 'CouponCodeController');
    Route::get('inActive/{id}', 'CouponCodeController@inActive');
    Route::get('active/{id}', 'CouponCodeController@active');
    Route::post('/get-sub-category', 'AjaxController@getSubCategory');
    Route::post('/mul-img-delete', 'AjaxController@delMulImage');
    Route::get('admin/payment-setting', 'AdminController@paymentSetting');
    Route::post('update-payment-setting', 'AdminController@updatePaymentSetting');
    Route::get('admin/manage-customers', 'AdminController@showCustomers');
    Route::get('admin/view-customer-details/{id}', 'AdminController@viewCustomerDetails');
    Route::get('admin/manage-orders', 'AdminController@showOrders');
    Route::get('admin/view-order-details/{id}', 'AdminController@viewOrderDetails');
    Route::get('admin/massage-therapists', 'AdminController@showMassageTherapists');
    Route::get('admin/massage-therapists-edit/{id}', 'AdminController@editMassageTherapists');
    Route::post('massage-therapists-update', 'AdminController@updateMassageTherapists');
    Route::get('admin/intutive-readers', 'AdminController@showIntutiveReaders');
    Route::get('admin/intutive-readers-edit/{id}', 'AdminController@editIntutiveReaders');
    Route::post('intutive-readers-update', 'AdminController@updateIntutiveReaders');    
    Route::get('admin/intutive-price-setting', 'AdminController@showIntutivePrices');
    Route::get('admin/intutive-reading-price-edit/{id}', 'AdminController@editIntutivePriceSetting');
    Route::post('intutive-readers-price-update', 'AdminController@updateIntutivePrice');
    
    Route::get('admin/massage-therapists-price-setting', 'AdminController@showMassageTherapyPrices');
    Route::get('admin/massage-therapy-price-edit/{id}', 'AdminController@editMassageTherapyPriceSetting');
    Route::post('massage-therapy-price-update', 'AdminController@updateMassageTherapyPrice');
    
    
    Route::post('update-shipping', 'AjaxController@updateShipping');
});


// User

Route::post('/save-nl-data', 'AjaxController@saveNewsLetterData');
Route::get('/', 'HomeController@index');
Route::get('/products', 'HomeController@getProducts');
Route::get('/product-details', 'HomeController@getProductDetails');
Route::post('/add-to-cart', 'CartController@addToCart');
Route::get('/cart', 'CartController@showCart');
Route::get('/about-us', 'HomeController@aboutUs');
Route::get('/privacy-policy', 'HomeController@privacyPolicy');
Route::get('/term-and-conditions', 'HomeController@termAndConditions');
Route::get('/contact-us', 'HomeController@contactUs');
Route::post('/contact-us-email', 'HomeController@sendContactEmail');
Route::get('/products/{param}', 'HomeController@getProductDetails');
Route::get('/user-login', 'UserController@userLogin');
Route::get('/user-logout', 'UserController@userLogout');
Route::post('/user-login-process', 'UserController@userLoginProcess');
Route::get('/checkout', 'CartController@checkout');
Route::get('/my-account', 'UserController@showMyAccount')->middleware('checkUserLogin');
Route::get('/edit-profile', 'UserController@showMyProfile')->middleware('checkUserLogin');
Route::post('/update-user-profile', 'UserController@updateProfile')->middleware('checkUserLogin');
Route::get('/order-details/{id}', 'UserController@viewOrderDetails')->middleware('checkUserLogin');
Route::post('/update-cart-item', 'CartController@updateCartItem');
Route::post('/delete-item-from-cart', 'CartController@deleteCartItem');
Route::post('/coupon-code', 'CartController@applyCouponcode');
Route::get('/change-password', 'UserController@showChangePassword')->middleware('checkUserLogin');
Route::post('/update-password', 'UserController@updatePassword')->middleware('checkUserLogin');
Route::post('/place-order-process', 'CartController@placeOrder');
Route::get('/paypal', 'CartController@showPaypal');
Route::get('/thankyou', 'CartController@showThankyou');
Route::get('/category/{param1}', 'HomeController@getCategoryProducts');
Route::get('/category/{param1}/{param2}', 'HomeController@getSubCategoryProducts');
Route::get('/psychic-reading', 'HomeController@psychicReading');
Route::get('/massage-therapy', 'HomeController@massageTherapy');
Route::get('/forgot-password', 'UserController@forgotPassword');
Route::post('/user-forgot-password', 'UserController@forgotPasswordCheck');
Route::post('/check-int-available-time', 'BookingController@chkIntutiveReadingTime');
Route::post('/ajax-available-time', 'BookingController@availableTimeCheck');



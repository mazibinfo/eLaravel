<?php

use Illuminate\Support\Facades\Route;

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

//frontend.........................
Route::get('/','HomeController@index');
Route::get('/category-by-product/{id}','HomeController@category_by_product');
Route::get('/product-by-brands/{id}','HomeController@product_by_brands');
Route::get('/product-details/{id}','HomeController@product_details');

//cart.............................
Route::post('/add-to-cart','CartController@add_to_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-item/{id}','CartController@delete_item');
Route::post('/update-cart','CartController@update_cart');

//checkout.........................
Route::get('/login-check','CheckoutController@login_check');
Route::post('/customer-registration','CheckoutController@customer_registration');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-shipping-details','CheckoutController@save_shipping_details');

//customer Login/Logout..........................
Route::post('/customer-login','CheckoutController@customer_login');
Route::get('/customer-logout','CheckoutController@customer_logout');

//payment........................................
Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');









//backend...........................
Route::get('/logout','SuperAdminController@logout');
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::post('/admin-dashboard','AdminController@dashboard');


//category..........................
Route::get('/add-category','CategoryController@index');
Route::get('/all-category','CategoryController@all_category');
Route::post('/save-category','CategoryController@add_category');
Route::get('/inactive-category/{id}','CategoryController@inactive_category');
Route::get('/active-category/{id}','CategoryController@active_category');
Route::get('/edit-category/{id}','CategoryController@edit_category');
Route::post('/update-category/{id}','CategoryController@update_category');
Route::get('/delete-category/{id}','CategoryController@delete_category');


//manufacture........................
Route::get('/add-manufacture','ManufactureController@index');
Route::post('/save-manufacture','ManufactureController@add_manufacture');
Route::get('/all-manufacture','ManufactureController@all_manufacture');
Route::get('/inactive-manufacture/{id}','ManufactureController@inactive_manufacture');
Route::get('/active-manufacture/{id}','ManufactureController@active_manufacture');
Route::get('/edit-manufacture/{id}','ManufactureController@edit_manufacture');
Route::post('/update-manufacture/{id}','ManufactureController@update_manufacture');
Route::get('/delete-manufacture/{id}','ManufactureController@delete_manufacture');

//Products...........................
Route::get('/add-product','ProductController@index');
Route::post('/save-product','ProductController@add_product');
Route::get('/all-product','ProductController@all_product');
Route::get('/inactive-product/{id}','ProductController@inactive_product');
Route::get('/active-product/{id}','ProductController@active_product');
Route::get('/edit-product/{id}','ProductController@edit_product');
Route::post('/update-product/{id}','ProductController@update_product');
Route::get('/delete-product/{id}','ProductController@delete_product');

//Slider.............................
Route::get('/add-slider','SliderController@index');
Route::post('/save-slider','SliderController@add_slider');
Route::get('/all-slider','SliderController@all_slider');
Route::get('/inactive-slider/{id}','SliderController@inactive_slider');
Route::get('/active-slider/{id}','SliderController@active_slider');
Route::get('/delete-slider/{id}','SliderController@delete_slider');


//Manage Order .....................................
Route::get('/manage-order','ManageOrderController@manage_order');
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


Auth::routes(['register' => false]);

Route::get('user/login', 'FrontendController@login')->name('login.form');
Route::post('user/login', 'FrontendController@loginSubmit')->name('login.submit');
Route::get('user/logout', 'FrontendController@logout')->name('user.logout');

Route::get('user/register', 'FrontendController@register')->name('register.form');
Route::post('user/register', 'FrontendController@registerSubmit')->name('register.submit');
// Socialite 
Route::get('login/{provider}/', 'Auth\LoginController@redirect')->name('login.redirect');
Route::get('login/{provider}/callback/', 'Auth\LoginController@Callback')->name('login.callback');

Route::get('/', 'FrontendController@home')->name('home');

// Frontend Routes
Route::get('/home', 'FrontendController@index');
Route::get('/about-us', 'FrontendController@aboutUs')->name('about-us');
Route::get('/contact', 'FrontendController@contact')->name('contact');
Route::get('product-detail/{slug}', 'FrontendController@productDetail')->name('product-detail');
Route::post('/product/search', 'FrontendController@productSearch')->name('product.search');
Route::get('/product-cat/{slug}', 'FrontendController@productCat')->name('product-cat');
Route::get('/product-sub-cat/{slug}/{sub_slug}', 'FrontendController@productSubCat')->name('product-sub-cat');
// Cart section
Route::get('/add-to-cart/{slug}', 'CartController@addToCart')->name('add-to-cart')->middleware('user');
Route::post('/add-to-cart', 'CartController@singleAddToCart')->name('single-add-to-cart')->middleware('user');
Route::get('cart-delete/{id}', 'CartController@cartDelete')->name('cart-delete');
Route::post('cart-update', 'CartController@cartUpdate')->name('cart.update');

Route::get('/cart', function () {
    return view('frontend.pages.cart');
})->name('cart');
Route::get('/checkout', 'CartController@checkout')->name('checkout')->middleware('user');
// Wishlist
Route::get('/wishlist', function () {
    return view('frontend.pages.wishlist');
})->name('wishlist');
Route::get('/wishlist/{slug}', 'WishlistController@wishlist')->name('add-to-wishlist')->middleware('user');
Route::get('wishlist-delete/{id}', 'WishlistController@wishlistDelete')->name('wishlist-delete');
Route::post('cart/order', 'OrderController@store')->name('cart.order');
Route::get('/income', 'OrderController@incomeChart')->name('product.order.income');
// Route::get('/user/chart','AdminController@userPieChart')->name('user.piechart');
Route::get('/product-grids', 'FrontendController@productGrids')->name('product-grids');
Route::get('/product-lists', 'FrontendController@productLists')->name('product-lists');
Route::match(['get', 'post'], '/filter', 'FrontendController@productFilter')->name('shop.filter');

Route::get('cancel', 'OrderController@Stripecancel')->name('stripe.cancel');
Route::get('success', 'OrderController@Stripesuccess')->name('stripe.success');



// Backend section start

Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'AdminController@index')->name('admin');

    // user route
    Route::resource('users', 'UsersController');
    // Category
    Route::resource('/category', 'CategoryController');
    // Product
    Route::resource('/product', 'ProductController');
    // Ajax for sub category
    Route::post('/category/{id}/child', 'CategoryController@getChildByParent');


    // Order
    Route::resource('/order', 'OrderController');
    // Shipping
    Route::resource('/shipping', 'ShippingController');
    // Password Change
    Route::get('change-password', 'AdminController@changePassword')->name('change.password.form');
    Route::post('change-password', 'AdminController@changPasswordStore')->name('change.password');
});


Route::get('/downloads', 'UsersController@downloads')->name('downloads');







// User section start
Route::group(['prefix' => '/user', 'middleware' => ['user']], function () {
    Route::get('/', 'HomeController@index')->name('user');
    // Profile
    //  Order
    Route::get('/order', "HomeController@orderIndex")->name('user.order.index');
    Route::get('/order/show/{id}', "HomeController@orderShow")->name('user.order.show');
    Route::delete('/order/delete/{id}', 'HomeController@userOrderDelete')->name('user.order.delete');


    // Password Change
    Route::get('change-password', 'HomeController@changePassword')->name('user.change.password.form');
    Route::post('change-password', 'HomeController@changPasswordStore')->name('user.change.password');
});

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::get('/topic/{topic}', 'TopicController@index')->name('topic') ;
/* เรียก
   app/Http/Controllers/TopicController.php ฟังก์ชั่น index()  พร้อมส่ง Parameter $_GET[] (ชื่อหมวดสินค้า) ไปให้--->
   เรียก
   View จาก resources/views/app/topic.blade.php
   สรุป TopicController ,app.Topic ,view ชื่อtopic.blade.php,Product.php,ProductFee.php

*/

   
Route::get('/product', 'ProductController@all')->name('product.all');
Route::get('/product/{product}', 'ProductController@index')->name('product');
Route::get('/blog', 'BlogController@index')->name('blog');
Route::get('/blog/{blog}', 'BlogController@view')->name('blog.single');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/gold-saving', 'HomeController@goldSaving')->name('gold-saving');

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart/add', 'CartController@addCart')->name('cart.add');
Route::post('/cart/get', 'CartController@getCart')->name('cart.get');
Route::post('/cart/clear', 'CartController@clearCart')->name('cart.clear');
Route::post('/cart/delete', 'CartController@deleteItem')->name('cart.delete');
Route::get('/cart/clear', 'CartController@clearCart')->name('cart.clear');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', 'CartController@checkout')->name('checkout');
    Route::post('/checkout', 'CartController@confirmCheckout')->name('checkout.confirm');

    Route::get('/account', 'AccountController@index')->name('account');
    Route::post('/account', 'AccountController@update')->name('account');
    Route::get('/account/order', 'OrderController@order')->name('account.order');
    Route::post('/account/order', 'OrderController@orderConfirm')->name('account.order');
    Route::get('/account/history', 'OrderController@history')->name('account.history');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::name('admin.')->group(function () {
        Route::get('/', 'HomeController@adminIndex')->name('index');

        Route::get('topic', 'TopicController@adminIndex')->name('topic');
        Route::get('topic/create', 'TopicController@adminView')->name('topic.create');
        Route::post('topic/create', 'TopicController@adminCreate')->name('topic.create');
        Route::get('topic/update', 'TopicController@adminViewUpdate')->name('topic.update');
        Route::post('topic/update', 'TopicController@adminUpdate')->name('topic.update');
        Route::post('topic/delete', 'TopicController@adminDelete')->name('topic.delete');

        Route::get('product', 'ProductController@adminIndex')->name('product');
        Route::get('product/create', 'ProductController@adminViewCreate')->name('product.create');
        Route::post('product/create', 'ProductController@adminCreate')->name('product.create');
        Route::get('product/update', 'ProductController@adminViewUpdate')->name('product.update');
        Route::post('product/update', 'ProductController@adminUpdate')->name('product.update');
        Route::post('product/upload', 'ProductController@uploadImage')->name('product.upload');
        Route::post('product/upload/delete', 'ProductController@deleteImage')->name('product.upload.delete');
        Route::post('product/delete', 'ProductController@adminDeleteProduct')->name('product.delete');

        Route::get('slide', 'SlideController@index')->name('slide');
        Route::get('slide/create', 'SlideController@viewCreate')->name('slide.create');
        Route::post('slide/create', 'SlideController@create')->name('slide.create');
        Route::post('slide/delete', 'SlideController@delete')->name('slide.delete');

        Route::get('bank', 'BankController@index')->name('bank');
        Route::get('bank/create', 'BankController@viewCreate')->name('bank.create');
        Route::post('bank/create', 'BankController@create')->name('bank.create');
        Route::get('bank/update', 'BankController@viewUpdate')->name('bank.update');
        Route::post('bank/update', 'BankController@update')->name('bank.update');

        Route::get('promotion', 'PromotionController@index')->name('promotion');
        Route::get('promotion/create', 'PromotionController@viewCreate')->name('promotion.create');
        Route::post('promotion/create', 'PromotionController@create')->name('promotion.create');
        Route::post('promotion/delete', 'PromotionController@delete')->name('promotion.delete');
        Route::get('promotion/update', 'PromotionController@viewUpdate')->name('promotion.update');
        Route::post('promotion/update', 'PromotionController@update')->name('promotion.update');
        


        Route::get('blog', 'BlogController@adminIndex')->name('blog');
        Route::get('blog/create', 'BlogController@adminViewCreate')->name('blog.create');
        Route::post('blog/create', 'BlogController@adminCreate')->name('blog.create');
        Route::get('blog/update', 'BlogController@adminViewUpdate')->name('blog.update');
        Route::post('blog/update', 'BlogController@adminUpdate')->name('blog.update');
        Route::post('blog/delete', 'BlogController@adminDelete')->name('blog.delete');

        Route::get('order', 'OrderController@adminIndex')->name('order');
        Route::get('order/update', 'OrderController@adminViewUpdate')->name('order.update');
        Route::post('order/update', 'OrderController@adminUpdate')->name('order.update');
    });
});

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('locale/{locale}', \App\Services\LocaleService::class)->name('locale');

Route::group(['prefix' => App\Http\Middleware\Localization::getLocale()], function(){

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Auth::routes();

    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'loginPhone'])->name('login.phone'); //Login Phone
    Route::post('/login_order', [\App\Http\Controllers\Auth\LoginController::class, 'loginOrder'])->name('login.order'); //Login from Order

    Route::get('/catalog/{slug}_{category}c', [\App\Http\Controllers\CatalogController::class, 'list'])->name('catalog');

    Route::get('/catalog/{slug}_{good}g', [\App\Http\Controllers\GoodController::class, 'index'])->name('good');

    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');

    Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'addCart'])->name('cart.add');
    Route::post('/cart/edit', [\App\Http\Controllers\CartController::class, 'editCart'])->name('cart.edit');
    Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'removeItemCart'])->name('cart.remove');
    Route::post('/cart/clean', [\App\Http\Controllers\CartController::class, 'cleanCart'])->name('cart.destroy');

    Route::post('/order/create', [\App\Http\Controllers\OrderController::class, 'createOrder'])->name('order.create');
//    Route::get('/order/created/{order}', [\App\Http\Controllers\OrderController::class, 'created'])->name('order.created');


    Route::group(['prefix' => 'user', 'middleware' => 'auth'], function (){
        Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
        Route::put('/profile/{user}', [\App\Http\Controllers\UserController::class, 'updateProfile'])->name('user.profile.update');
        Route::get('/password', [\App\Http\Controllers\UserController::class, 'password'])->name('user.password');
        Route::put('/password/{user}', [\App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.password.update');
        Route::get('/orders', [\App\Http\Controllers\UserController::class, 'orders'])->name('user.orders');
        Route::get('/order/{order}', [\App\Http\Controllers\UserController::class, 'order'])->name('user.order');
    });

//    Route::get('/user/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
//    Route::put('/user/profile/{user}', [\App\Http\Controllers\UserController::class, 'updateProfile'])->name('user.profile.update');
//    Route::get('/user/password', [\App\Http\Controllers\UserController::class, 'password'])->name('user.password');
//    Route::put('/user/password/{user}', [\App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.password.update');
//    Route::get('/user/orders', [\App\Http\Controllers\UserController::class, 'orders'])->name('user.orders');
//    Route::get('/user/order/{order}', [\App\Http\Controllers\UserController::class, 'order'])->name('user.order');

//    Route::resource('user', \App\Http\Controllers\UserController::class);

});

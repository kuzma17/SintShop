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


Route::get('locale/{locale}', \App\Services\LocaleService::class)->name('locale');

Route::group(['prefix' => App\Http\Middleware\Localization::getLocaleUrl()], function(){

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



    Auth::routes();

    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'loginPhone'])->name('login.phone'); //Login Phone
    Route::post('/login_order', [\App\Http\Controllers\Auth\LoginController::class, 'loginOrder'])->name('login.order'); //Login from Order

    Route::get('/catalog/search', [\App\Http\Controllers\SearchController::class, 'search'])->middleware('throttle:5,1')->name('search');

    Route::get('/catalog/sale', [\App\Http\Controllers\CatalogController::class, 'SaleList'])->name('catalog.sale');

    Route::get('/catalog/{slug}', [\App\Http\Controllers\CatalogController::class, 'list'])->name('catalog');

    Route::get('/catalog/{category}/{slug}', [\App\Http\Controllers\GoodController::class, 'index'])->name('good');

    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');

    Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'addCart'])->name('cart.add');
    Route::post('/cart/edit', [\App\Http\Controllers\CartController::class, 'editCart'])->name('cart.edit');
    Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'removeItemCart'])->name('cart.remove');
    Route::post('/cart/clean', [\App\Http\Controllers\CartController::class, 'cleanCart'])->name('cart.destroy');

    Route::post('/order/create', [\App\Http\Controllers\OrderController::class, 'createOrder'])->name('order.create');
//    Route::get('/order/created/{order}', [\App\Http\Controllers\OrderController::class, 'created'])->name('order.created');

    Route::get('/post/{slug}', [\App\Http\Controllers\PostController::class, 'post'])->name('post');


    Route::group(['prefix' => 'user', 'middleware' => 'auth'], function (){
        Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
        Route::put('/profile/{user}', [\App\Http\Controllers\UserController::class, 'updateProfile'])->name('user.profile.update');
        Route::get('/password', [\App\Http\Controllers\UserController::class, 'password'])->name('user.password');
        Route::put('/password/{user}', [\App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.password.update');
        Route::get('/orders', [\App\Http\Controllers\UserController::class, 'orders'])->name('user.orders');
        Route::get('/order/{order}', [\App\Http\Controllers\UserController::class, 'order'])->name('user.order');
    });





    Route::get('/admin/login', [App\Http\Controllers\Admin\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [App\Http\Controllers\Admin\AdminLoginController::class, 'login'])->name('admin.login');
    Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => 'admin.auth'], function () {
        Route::get('/', [App\Http\Controllers\PageController::class, 'admin'])->name('admin');
        Route::resource('/goods', \App\Http\Controllers\Admin\AdminGoodController::class);
        Route::resource('/categories', \App\Http\Controllers\Admin\AdminCategoryController::class);

        Route::get('/orders/index', [\App\Http\Controllers\Admin\AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}/edit', [\App\Http\Controllers\Admin\AdminOrderController::class, 'edit'])->name('orders.edit');
        Route::put('/orders/{order}', [\App\Http\Controllers\Admin\AdminOrderController::class, 'update'])->name('orders.update');

        Route::get('/customers/', [\App\Http\Controllers\Admin\AdminClientController::class, 'index'])->name('clients.index');
        Route::get('/customers/{user}', [\App\Http\Controllers\Admin\AdminClientController::class, 'show'])->name('clients.show');

        Route::resource('/attributes', \App\Http\Controllers\Admin\AdminAttributeController::class);

        Route::get('/goods/category/{category}/attributes', [\App\Http\Controllers\Admin\AdminGoodController::class, 'getAttributes']);

        Route::resource('pages', \App\Http\Controllers\Admin\AdminPageController::class);

        Route::resource('posts', \App\Http\Controllers\Admin\AdminPostController::class);

        Route::get('/settings', [\App\Http\Controllers\Admin\AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings/update', [\App\Http\Controllers\Admin\AdminSettingController::class, 'update'])->name('settings.update');

        Route::resource('users', \App\Http\Controllers\Admin\AdminUserController::class);

        Route::resource('vendors', \App\Http\Controllers\Admin\AdminVendorController::class);
    });

    Route::post('/photo/multi-upload', [\App\Http\Controllers\PhotoController::class, 'multiUpload']);
    Route::post('/photo/upload', [\App\Http\Controllers\PhotoController::class, 'upload']);
    Route::get('/photo/{photo}/delete', [\App\Http\Controllers\PhotoController::class, 'delete']);

    Route::get('/nova-poshta', [\App\Http\Controllers\NovaPoshtaController::class, 'index']);

    Route::post('/callback', \App\Http\Controllers\CallBackController::class)->name('callback');


    Route::get('/{page}', [App\Http\Controllers\PageController::class, 'page'])
        ->where('page', '^(?!home$).*$') // Исключаем "home"
        ->name('page');

});

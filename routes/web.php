<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\ProductController as SanphamController;
use App\Http\Controllers\frontend\ContactController;

use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\TopicController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\MenuController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\ContactController as ChitetController;
use App\Http\Controllers\backend\AuthController;

// use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


route::get('/', [HomeController::class, 'index'])->name('site.home');
route::get('/san-pham', [SanphamController::class, 'index'])->name('site.product');
route::get('/san-pham/{slug}', [SanphamController::class, 'detail'])->name('site.product.detail');
route::get('/lien-he', [ContactController::class, 'index'])->name('site.contact');
//Admin
// Auth routes
Route::get('login', [AuthController::class, 'index'])->name('admin.login');
Route::post('login', [AuthController::class, 'dologin'])->name('admin.dologin');

Route::get('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::get('admin/register', [AuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('admin/register', [AuthController::class, 'register'])->name('admin.register.post');

// Route::prefix('admin')->middleware(['LoginAdmin'])->group(function () {
//     Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//     // Các route quản lý khác...
// }); 


Route::prefix('admin')->middleware('loginadmin')->group(function () {
    route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    //Brand
    route::prefix('brand')->group(function () {
        route::get('/trash', [BrandController::class, 'trash'])->name('brand.trash');
        route::get('/delete/{brand}', [BrandController::class, 'delete'])->name('brand.delete');
        route::get('/restore/{brand}', [BrandController::class, 'restore'])->name('brand.restore');
        route::get('status/{brand}', [BrandController::class, 'status'])->name('brand.status');
    });
    route::resource('brand', BrandController::class);

    //category
    route::prefix('category')->group(function () {
        route::get('/trash', [CategoryController::class, 'trash'])->name('category.trash');
        route::get('/delete/{category}', [CategoryController::class, 'delete'])->name('category.delete');
        route::get('/restore/{category}', [CategoryController::class, 'restore'])->name('category.restore');
        route::get('status/{category}', [categoryController::class, 'status'])->name('category.status');
        Route::get('/admin/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    });
    route::resource('category', CategoryController::class);

    //product
    route::prefix('product')->group(function () {
        route::get('/trash', [ProductController::class, 'trash'])->name('product.trash');
        route::get('/delete/{product}', [ProductController::class, 'delete'])->name('product.delete');
        route::get('/restore/{product}', [ProductController::class, 'restore'])->name('product.restore');
        route::get('status/{product}', [ProductController::class, 'status'])->name('product.status');
    });
    route::resource('product', ProductController::class);

    //order
    route::prefix('order')->group(function () {
        route::get('/trash', [OrderController::class, 'trash'])->name('order.trash');
        route::get('/delete/{order}', [OrderController::class, 'delete'])->name('order.delete');
        route::get('/restore/{order}', [OrderController::class, 'restore'])->name('order.restore');
        route::get('status/{order}', [OrderController::class, 'status'])->name('order.status');
    });
    route::resource('order', OrderController::class);

    //topic
    route::prefix('topic')->group(function () {
        route::get('/trash', [TopicController::class, 'trash'])->name('topic.trash');
        route::get('/delete/{topic}', [TopicController::class, 'delete'])->name('topic.delete');
        route::get('/restore/{topic}', [TopicController::class, 'restore'])->name('topic.restore');
        route::get('status/{topic}', [TopicController::class, 'status'])->name('topic.status');
    });
    route::resource('topic', TopicController::class);

    //post
    route::prefix('post')->group(function () {
        route::get('/trash', [PostController::class, 'trash'])->name('post.trash');
        route::get('/delete/{post}', [PostController::class, 'delete'])->name('post.delete');
        route::get('/restore/{post}', [PostController::class, 'restore'])->name('post.restore');
        route::get('status/{post}', [PostController::class, 'status'])->name('post.status');
    });
    route::resource('post', PostController::class);

    //contact
    route::prefix('contact')->group(function () {
        route::get('/trash', [ChitetController::class, 'trash'])->name('contact.trash');
        Route::get('/contact', [ContactController::class, 'index'])->name('frontend.contact');
        route::get('/delete/{contact}', [ChitetController::class, 'delete'])->name('contact.delete');
        route::get('/restore/{contact}', [ChitetController::class, 'restore'])->name('contact.restore');
        route::get('status/{contact}', [ChitetController::class, 'status'])->name('contact.status');
    });
    route::resource('contact', ChitetController::class); //gọi để controller của contact đi đúng hướng

    //user
    route::prefix('user')->group(function () {
        route::get('/trash', [UserController::class, 'trash'])->name('user.trash');
        route::get('/delete/{user}', [UserController::class, 'delete'])->name('user.delete');
        route::get('/restore/{user}', [UserController::class, 'restore'])->name('user.restore');
        route::get('status/{user}', [UserController::class, 'status'])->name('user.status');
    });
    route::resource('user', UserController::class);

    //menu
    route::prefix('menu')->group(function () {
        route::get('/trash', [MenuController::class, 'trash'])->name('menu.trash');
        route::get('/delete/{menu}', [MenuController::class, 'delete'])->name('menu.delete');
        route::get('/restore/{menu}', [MenuController::class, 'restore'])->name('menu.restore');
        route::get('status/{menu}', [MenuController::class, 'status'])->name('menu.status');
    });
    route::resource('menu', MenuController::class);

    //banner
    route::prefix('banner')->group(function () {
        route::get('/trash', [BannerController::class, 'trash'])->name('banner.trash');
        route::get('/delete/{banner}', [BannerController::class, 'delete'])->name('banner.delete');
        route::get('/restore/{banner}', [BannerController::class, 'restore'])->name('banner.restore');
        route::get('status/{banner}', [BannerController::class, 'status'])->name('banner.status');
    });
    route::resource('banner', BannerController::class);

    //mới



});

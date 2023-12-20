<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CartController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MagazinController;
use App\Http\Controllers\Auth2\RegisterController;
use App\Http\Controllers\Auth2\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LangController;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::get('lang/{lang}', [LangController::class, 'switchLang'])->name('switch.lang');

Route::prefix('admin')->as('admin.')->middleware('hasRole: admin')->group(function (){
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/search', [UserController::class, 'index'])->name('users.search');
    Route::get('/cart', [AdminController::class, 'cart'])->name('admin.cart');
    Route::put('/cart/{cart}/confirm', [AdminController::class, 'confirm'])->name('cart.confirm');
//    Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
//    Route::put('/users/{user}',[UserController::class,'update'])->name('users.update');
//    Route::put('/users/{user}/ban',[UserController::class,'ban'])->name('users.ban');
//    Route::put('/users/{user}/unban',[UserController::class,'unban'])->name('users.unban');
});

Route::middleware('auth')->group(function (){
    Route::resource('posts', MagazinController::class)->except('index', 'show');
    Route::resource('/comments', CommentController::class )->only('store', 'destroy');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/posts/{post}/rate', [MagazinController::class, 'rate'])->name('posts.rate');

    Route::post('/cart/{post}/putToCart', [CartController::class, 'putToCart'])->name('cart.puttocart');
    Route::post('/cart/{post}/deleteFromCart', [CartController::class, 'deleteFromCart'])->name('cart.deletefromcart');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{user}', [CartController::class, 'buy'])->name('cart.buy');

    Route::get('/post/user/kabinet',[MagazinController::class,'office'])->name('post.user');
    Route::get('/edit/profile/{user}',[RegisterController::class,'editregister'])->name('posts.editregister');
    Route::put('update/profile/{user}',[RegisterController::class,'updateregister'])->name('posts.updateregister');
    Route::get('/shot', [UserController::class, 'shot'])->name('posts.shot');
    Route::post('posts/{user}/addMoney', [UserController::class, 'addMoney'])->name('posts.addMoney');

});



Route::resource('posts', MagazinController::class)->only('index', 'show');
Route::get('/posts/category/{category}', [MagazinController::class, 'postsByCat'])->name('posts.category');

Route::get('/register', [RegisterController::class, 'create'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'create'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();

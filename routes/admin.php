<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

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



Route::match(['GET','POST'], '/login', [AuthController::class, 'login'])->name('admin.login');
Route::match(['GET','POST'], '/register', [AuthController::class, 'register'])->name('admin.register');

Route::middleware('auth:admin')->group(function(){
    Route::get('/logout',[AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/',function(){
        return view('backend.pages.dashboard');
    })->name('admin.dashboard');
    Route::resource('categories',CategoryController::class);
    Route::resource('products',ProductController::class);
});

Route::fallback(function(){
    dd('errror');
});
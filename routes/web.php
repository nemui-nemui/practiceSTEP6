<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/login', [App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');

Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');

Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

Route::get('/products/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');

Route::post('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');

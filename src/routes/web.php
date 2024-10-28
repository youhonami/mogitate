<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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

Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::post('/register', [ProductsController::class, 'register']);
Route::post('/store', [ProductsController::class, 'store']);
Route::get('/products/{id}', [ProductsController::class, 'show'])->name('products.show');
Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
Route::get('/search', [ProductsController::class, 'search'])->name('products.search');
Route::put('/products/{id}', [ProductsController::class, 'update'])->name('products.update');

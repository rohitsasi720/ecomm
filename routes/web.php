<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mycontroller;

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

Route::resource('products', mycontroller::class);

Route::get('cart', [mycontroller::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [mycontroller::class, 'addToCart'])->name('add.to.cart');
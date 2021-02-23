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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/orders/new/create', [\App\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
Route::post('/orders/new/store', [\App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{type}', [\App\Http\Controllers\OrderController::class, 'getOrders'])->name('orders');
Route::get('/orders/{order}/detail', [\App\Http\Controllers\OrderController::class, 'detail'])->name('order.detail');
Route::get('/orders/{order}/pay', [\App\Http\Controllers\PaymentController::class, 'makePayment'])->name('order.pay');
Route::put('/orders/{order}/cancel', [\App\Http\Controllers\OrderController::class, 'cancelOrder'])->name('order.cancel');
Route::post('/payment', [\App\Http\Controllers\PaymentController::class, 'store'])->name('payment.store');

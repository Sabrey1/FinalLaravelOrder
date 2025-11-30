<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('layouts.app');
})->name('app');

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::get('/category/show/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');


Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::put('/product/update', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');


Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
Route::get('/order/edit', [OrderController::class, 'edit'])->name('order.edit');
Route::get('/order/show/{id}', [OrderController::class, 'show'])->name('order.show');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::put('/order/update', [OrderController::class, 'update'])->name('order.update');
Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('order.destroy');

<?php

use Illuminate\Support\Facades\Route;


// import backend contoller
use App\Http\Controllers\Backend\HomeController as BackendHomeController;
use App\Http\Controllers\Backend\ProductController as BackendProductController;

// product
Route::get('/backend/manage/product', [BackendProductController::class, 'index'])->name("backend.manage.product");
Route::get('/backend/create/product', [BackendProductController::class, 'create'])->name("backend.create.product");
Route::post('/backend/create/process/product', [BackendProductController::class, 'create_process'])->name("backend.create.process.product");
Route::get('/backend/edit/product/{id?}', [BackendProductController::class, 'edit'])->name("backend.edit.product");
Route::post('/backend/edit/process/product', [BackendProductController::class, 'edit_process'])->name("backend.edit.process.product");
Route::delete('/backend/destroy/process/product/{id?}', [BackendProductController::class, 'destroy'])->name("backend.destroy.process.product");

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/product', function () {
    return view('product');
})->name('product');

Auth::routes([
    'login ' => true,
    'register ' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/backend', [BackendHomeController::class, 'index'])->name('backend');

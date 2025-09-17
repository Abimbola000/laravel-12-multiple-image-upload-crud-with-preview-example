<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);
Route::get ('products/delete-images/{id}', [ProductController::class,'destroyImages'])->name('images.destroy');



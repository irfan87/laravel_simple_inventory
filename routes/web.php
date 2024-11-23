<?php

use App\Http\Controllers\ItemsController;
use App\Models\Item;
use Illuminate\Support\Facades\Route;

Route::get('/', [ItemsController::class, 'index'])->name('home');

Route::get('/products/create', [ItemsController::class, 'create']);

Route::post('/products', [ItemsController::class, 'store']);

Route::get('/products/{product}/edit', [ItemsController::class, 'edit']);

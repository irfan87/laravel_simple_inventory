<?php

use App\Models\Item;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $items = Item::all();

    return view('home', [
        'items' => $items
    ]);
});

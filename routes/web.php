<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;


Route::get('/', function () {
    return redirect()->route('orders.index');
});

Route::resource('orders', OrderController::class); //resource berisi route CRUD ✌️

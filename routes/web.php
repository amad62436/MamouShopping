<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

// Les routes du Client

Route::get('/', [ClientController::class, 'home']);

Route::get('/shop1', [ClientController::class, 'shop1']);

Route::get('/shop2', [ClientController::class, 'shop2']);

Route::get('/shop3', [ClientController::class, 'shop3']);

Route::get('/cart', [ClientController::class, 'cart']);
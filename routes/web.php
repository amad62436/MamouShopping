<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Les routes du Client

Route::get('/', [ClientController::class, 'home']);

Route::get('/shop1', [ClientController::class, 'shop1']);

Route::get('/shop2', [ClientController::class, 'shop2']);

Route::get('/shop3', [ClientController::class, 'shop3']);

Route::get('/cart', [ClientController::class, 'cart']);

Route::get('/register', [ClientController::class, 'register']);

Route::get('/login', [ClientController::class, 'login']);

Route::get('/contact', [ClientController::class, 'contact']);

// Les routes pour l'admin 
Route::get('/admin-home', [AdminController::class, 'home']);

Route::get('/admin/addcategory', [AdminController::class, 'addcategory']);

Route::get('/admin/categories_list', [AdminController::class, 'categories_list']);

Route::get('/admin/addproduct', [AdminController::class, 'addproduct']);

Route::get('/admin/produits_list', [AdminController::class, 'produits_list']);

// Routes pour les categories
Route::post('/admin/savecategory', [CategoryController::class, 'savecategory']);
Route::delete('/admin/deletecategory/{id}', [CategoryController::class, 'deletecategory']);
Route::get('/admin/editcategory/{id}', [CategoryController::class, 'editcategory']);
Route::put('admin/updatecategory/{id}', [CategoryController::class, 'updatecategory']);

// Routes pour les produits
Route::post('/admin/saveproduct', [ProductController::class, 'saveproduct']);
Route::delete('/admin/deleteproduct/{id}', [ProductController::class, 'deleteproduct']);
Route::get('/admin/editproduct/{id}', [ProductController::class, 'editproduct']);
Route::put('admin/updateproduct/{id}', [ProductController::class, 'updateproduct']);


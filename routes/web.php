<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Routes Client (Frontend) - AVEC CACHE HTTP
|--------------------------------------------------------------------------
*/

// Groupe avec cache HTTP pour les pages statiques
Route::middleware('cache.headers:public;max_age=300;etag')->group(function () {
    
    Route::name('client.')->group(function () {
        // Page d'accueil avec cache
        Route::get('/', [ClientController::class, 'home'])->name('home');
        
        // Boutiques avec cache
        Route::get('/shop1', [ClientController::class, 'shop1'])->name('shop1');
        Route::get('/shop2', [ClientController::class, 'shop2'])->name('shop2');
        Route::get('/shop3', [ClientController::class, 'shop3'])->name('shop3');
        
        // Pages statiques avec cache
        Route::get('/contact', [ClientController::class, 'contact'])->name('contact');
        
        // Routes dynamiques avec cache
        Route::get('/categorie/{category:slug}', [ClientController::class, 'categoryProducts'])->name('category.products');
        Route::get('/produit/{id}', [ClientController::class, 'productDetail'])->name('product.detail');
    });
});

// Routes sans cache (contenu dynamique)
Route::name('client.')->group(function () {
    Route::get('/cart', [ClientController::class, 'cart'])->name('cart');
    Route::get('/register', [ClientController::class, 'register'])->name('register');
    Route::get('/login', [ClientController::class, 'login'])->name('login');
    Route::get('/wishlist', [ClientController::class, 'wishlist'])->name('wishlist');
    Route::get('/account', [ClientController::class, 'account'])->name('account');
    
    // Recherche avec cache court
    Route::get('/recherche', [ClientController::class, 'search'])
         ->name('search')
         ->middleware('cache.headers:public;max_age=120;etag');
});

// Routes panier
Route::prefix('cart')->name('cart.')->group(function () {
    // Ajouter au panier (accessible sans connexion)
    Route::post('/add/{id}', [CartController::class, 'add'])->name('add');
    
    // Routes protégées (nécessitent une connexion)
    Route::middleware('auth')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::put('/update/{id}', [CartController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
        Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
    });
});

// Routes commandes avec middleware PERSONNALISÉ
Route::prefix('orders')->name('orders.')->middleware(['auth'])->group(function () {
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout');
    Route::post('/store', [OrderController::class, 'store'])->name('store');
    Route::get('/confirmation/{id}', [OrderController::class, 'confirmation'])->name('confirmation');
    Route::get('/history', [OrderController::class, 'index'])->name('history');
    Route::get('/{id}', [OrderController::class, 'show'])->name('show');
});

// Routes ADMIN pour les commandes (PROTÉGÉES par auth et admin)
Route::prefix('admin/orders')->name('admin.orders.')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminOrderController::class, 'index'])->name('index');
    Route::get('/pending', [AdminOrderController::class, 'pending'])->name('pending');
    Route::get('/pending/count', [AdminOrderController::class, 'pendingCount'])->name('pending.count');
    Route::post('/approve/{id}', [AdminOrderController::class, 'approve'])->name('approve');
    Route::post('/reject/{id}', [AdminOrderController::class, 'reject'])->name('reject');
    Route::get('/{id}', [AdminOrderController::class, 'show'])->name('show');
});

// Routes pour le profil utilisateur (protégées par auth)
Route::middleware('auth')->group(function () {
    Route::get('/mon-compte/edit', [ClientController::class, 'editAccount'])->name('client.account.edit');
    Route::put('/mon-compte/update', [ClientController::class, 'updateAccount'])->name('client.account.update');
    Route::get('/mon-compte/change-password', [ClientController::class, 'showChangePasswordForm'])->name('client.password.edit');
    Route::post('/mon-compte/change-password', [ClientController::class, 'updatePassword'])->name('client.password.update');
});

// Routes pour les factures
Route::prefix('invoices')->name('invoices.')->group(function () {
    Route::get('/order/{order}', [InvoiceController::class, 'show'])->name('show');
    Route::get('/order/{order}/download', [InvoiceController::class, 'download'])->name('download');
    Route::get('/order/{order}/preview', [InvoiceController::class, 'preview'])->name('preview');
});

// Routes d'authentification
Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/auth/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/auth/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Routes Admin (Backend) - Préfixe 'admin' (SANS CACHE)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    
    // Routes de l'admin (pages)
    Route::get('/dashboard', [AdminController::class, 'home'])->name('dashboard');
    Route::get('/addcategory', [AdminController::class, 'addcategory'])->name('addcategory');
    Route::get('/categories', [AdminController::class, 'categories_list'])->name('categories.list');
    Route::get('/addproduct', [AdminController::class, 'addproduct'])->name('addproduct');
    Route::get('/products', [AdminController::class, 'produits_list'])->name('products.list');
    
    // Routes pour les catégories (CRUD)
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::post('/store', [CategoryController::class, 'savecategory'])->name('store');
        Route::delete('/delete/{id}', [CategoryController::class, 'deletecategory'])->name('delete');
        Route::get('/edit/{id}', [CategoryController::class, 'editcategory'])->name('edit');
        Route::put('/update/{id}', [CategoryController::class, 'updatecategory'])->name('update');
        Route::patch('/toggle/{id}', [CategoryController::class, 'toggleCategory'])->name('toggle');
    });
    
    // Routes pour les produits (CRUD)
    Route::prefix('products')->name('products.')->group(function () {
        Route::post('/store', [ProductController::class, 'saveproduct'])->name('store');
        Route::delete('/delete/{id}', [ProductController::class, 'deleteproduct'])->name('delete');
        Route::get('/edit/{id}', [ProductController::class, 'editproduct'])->name('edit');
        Route::put('/update/{id}', [ProductController::class, 'updateproduct'])->name('update');
        Route::patch('/toggle/{id}', [ProductController::class, 'toggleProduct'])->name('toggle');
    });
});

/*
|--------------------------------------------------------------------------
| Redirections pour compatibilité (anciennes URLs)
|--------------------------------------------------------------------------
*/

// Redirections pour les anciennes URLs admin
Route::get('/admin-home', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('/admin/categories_list', function () {
    return redirect()->route('admin.categories.list');
});

Route::get('/admin/produits_list', function () {
    return redirect()->route('admin.products.list');
});

/*
|--------------------------------------------------------------------------
| Route de fallback (404)
|--------------------------------------------------------------------------
*/

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// TEST ROUTE - À supprimer après vérification
Route::get('/test-server', function () {
    return response()->json([
        'status' => 'success',
        'server' => 'PHP Built-in Server',
        'port' => getenv('PORT'),
        'document_root' => base_path(),
        'time' => now()->toDateTimeString()
    ]);
});
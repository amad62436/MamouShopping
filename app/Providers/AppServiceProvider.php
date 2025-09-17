<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // ================= OPTIMISATIONS AVEC REDIS =================

        // Cache des catégories avec Redis - 1 heure
        View::composer('*', function ($view) {
            try {
                $categories = Cache::store('redis')->remember('global_categories', 3600, function () {
                    return Category::where('is_active', 1)
                                 ->select('id', 'name', 'slug', 'image')
                                 ->orderBy('name')
                                 ->get();
                });
            } catch (\Exception $e) {
                // Fallback si Redis n'est pas disponible
                $categories = Category::where('is_active', 1)
                                 ->select('id', 'name', 'slug', 'image')
                                 ->orderBy('name')
                                 ->get();
            }
            
            $view->with('globalCategories', $categories);
        });

        // Cache des produits populaires avec Redis - 30 minutes
        View::composer(['clients.home', 'clients.layout'], function ($view) {
            try {
                $featuredProducts = Cache::store('redis')->remember('featured_products', 1800, function () {
                    return Product::where('is_active', 1)
                                ->where('quantity', '>', 0)
                                ->select('id', 'name', 'price', 'front_image', 'slug', 'quantity')
                                ->orderBy('created_at', 'desc')
                                ->get();
                });
            } catch (\Exception $e) {
                // Fallback si Redis n'est pas disponible
                $featuredProducts = Product::where('is_active', 1)
                                ->where('quantity', '>', 0)
                                ->select('id', 'name', 'price', 'front_image', 'slug', 'quantity')
                                ->orderBy('created_at', 'desc')
                                ->get();
            }
            
            $view->with('featuredProducts', $featuredProducts);
        });

        // Cache des statistiques admin avec Redis - 24 heures
        View::composer('admin.dashboard', function ($view) {
            try {
                $stats = Cache::store('redis')->remember('admin_stats', 86400, function () {
                    return [
                        'total_products' => Product::count(),
                        'active_products' => Product::where('is_active', 1)->count(),
                        'out_of_stock' => Product::where('quantity', 0)->count(),
                        'total_categories' => Category::count(),
                    ];
                });
            } catch (\Exception $e) {
                // Fallback si Redis n'est pas disponible
                $stats = [
                    'total_products' => Product::count(),
                    'active_products' => Product::where('is_active', 1)->count(),
                    'out_of_stock' => Product::where('quantity', 0)->count(),
                    'total_categories' => Category::count(),
                ];
            }
            
            $view->with('stats', $stats);
        });

        // Optimisation des requêtes pour l'environnement de production
        if ($this->app->environment('production')) {
            \Illuminate\Database\Eloquent\Builder::macro('optimized', function () {
                return $this->select(array_merge(
                    ['id'], 
                    $this->getModel()->getFillable()
                ));
            });
        }
    }
}
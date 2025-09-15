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

        // ================= OPTIMISATIONS AJOUTÉES =================

        // Cache des catégories pour toutes les vues - 1 heure
        View::composer('*', function ($view) {
            $categories = Cache::remember('global_categories', 3600, function () {
                return Category::where('is_active', 1)
                             ->select('id', 'name', 'slug', 'image')
                             ->orderBy('name')
                             ->get();
            });
            
            $view->with('globalCategories', $categories);
        });

        // Cache des produits populaires - 30 minutes
        View::composer(['clients.home', 'clients.layout'], function ($view) {
            $featuredProducts = Cache::remember('featured_products', 1800, function () {
                return Product::where('is_active', 1)
                            ->where('quantity', '>', 0)
                            ->select('id', 'name', 'price', 'front_image', 'slug', 'quantity')
                            ->orderBy('created_at', 'desc')
                            ->take(8)
                            ->get();
            });
            
            $view->with('featuredProducts', $featuredProducts);
        });

        // Cache des statistiques admin - 24 heures
        View::composer('admin.dashboard', function ($view) {
            $stats = Cache::remember('admin_stats', 86400, function () {
                return [
                    'total_products' => Product::count(),
                    'active_products' => Product::where('is_active', 1)->count(),
                    'out_of_stock' => Product::where('quantity', 0)->count(),
                    'total_categories' => Category::count(),
                ];
            });
            
            $view->with('stats', $stats);
        });

        // ================= OPTIMISATIONS AJOUTÉES =================
        if ($this->app->environment('production')) {
            \Illuminate\Database\Eloquent\Builder::macro('optimized', function () {
                return $this->select(array_merge(
                    ['id'], 
                    $this->model->getFillable() ?? []
                ));
            });
        }
    }
}
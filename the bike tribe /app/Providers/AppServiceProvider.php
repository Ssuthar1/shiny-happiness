<?php

namespace App\Providers;
use Illuminate\Support\Facades\View; 
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;  
use App\Models\TourCategory;
use App\Models\Tour;
use Config;

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
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
        /* Tour Categories */
        $tour_categories = TourCategory::select('id','title','slug')->where('status',1)->get()->toArray();
        View::share('global_tour_categories', $tour_categories);

        /* Tours */
        $tours = Tour::select('id','title','slug','tour_category_id','featured_image','start_price')->where('status',1)->get()->toArray();
        View::share('global_tours', $tours);

        View::share('currency', '₹');
    }
}

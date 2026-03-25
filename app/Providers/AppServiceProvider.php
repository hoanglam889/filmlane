<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Country;
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
        View::composer('*', function ($view) {
            
            // Gọi DB lấy danh sách Thể loại và Quốc gia
            $categories = Category::orderBy('title', 'ASC')->get();
            $countries = Country::orderBy('title', 'ASC')->get();

            // Bơm 2 biến này ra View
            $view->with(compact('categories', 'countries'));
        });
    }
}

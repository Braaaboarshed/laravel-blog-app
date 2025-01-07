<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\ServiceProvider;

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
        view()->share('tag', Tag::all());
        view()->share('category', Category::all());
    }
}

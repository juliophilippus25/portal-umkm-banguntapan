<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\HeaderComposer;
use App\Http\View\Composers\HeaderLandingPageComposer;

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
        View::composer('layouts.header', HeaderComposer::class);
        View::composer('landing-page.layouts.header', HeaderLandingPageComposer::class);
    }
}

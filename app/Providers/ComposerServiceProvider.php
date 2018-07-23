<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        //For Backend Sidebar Menu
        view()->creator('backend.layouts.partials.menubar', 'App\Http\ViewCreators\BackendMenuCreator');

        //For Frontend Header Menu
        view()->creator('frontend.layouts.partials.header', 'App\Http\ViewCreators\FrontendMenuCreator');

        //For Slider
        view()->creator('frontend.home.partials.slider', 'App\Http\ViewCreators\FrontendSliderCreator');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

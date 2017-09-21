<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        View::composer('permission.layouts.sidebar', \App\Http\ViewComposers\Permission\SidebarComposer::class);
        View::composer('permission.layouts.breadcrumb', \App\Http\ViewComposers\Permission\BreadcrumbComposer::class);
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

<?php

namespace App\Providers;

use App\View\Composers\CartComposer;
use App\View\Composers\NotificationComposer;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer(['layouts.member.header'], CartComposer::class);
        \View::composer('layouts.admin.header', NotificationComposer::class);
    }
}

<?php

namespace App\Providers;

use App\InboxMessage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use InboxMessageObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // listen model events
        InboxMessage::observe(InboxMessageObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

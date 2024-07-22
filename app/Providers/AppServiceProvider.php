<?php

namespace App\Providers;

use Livewire\Livewire;
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
        Livewire::component('components.search-businesses', \App\Http\Livewire\Components\Businesses\SearchBusinesses::class);
        Livewire::component('components.table-businesses', \App\Http\Livewire\Components\Businesses\TableBusinesses::class);
    }
}

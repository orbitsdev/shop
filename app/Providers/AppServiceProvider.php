<?php

namespace App\Providers;


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentColor;

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
        Model::unguard();
        Schema::defaultStringLength(191);
        FilamentColor::register([
           
            'primary' => "#d72f59",
            
        ]);
       

    }
}

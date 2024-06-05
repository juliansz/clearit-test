<?php

namespace App\Providers;
use App\Models\BookedClass;
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
        \Illuminate\Support\Facades\Route::bind('bookedClass', function (string $value) {
            return BookedClass::where('id', $value)->firstOrFail();
        });
    }
}

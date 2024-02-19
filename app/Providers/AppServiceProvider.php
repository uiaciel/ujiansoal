<?php

namespace App\Providers;

use App\Models\Kelas;
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
        \Carbon\Carbon::setLocale('id');

        view()->composer(
            '*', function ($view) {
                $view->with([
                    'kelas' => Kelas::All(),
                ]);
            }
        );
    }
}

<?php

namespace App\Providers;

use App\Interfaces\DoctorInterface;
use App\Repositories\DoctorRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

if (!function_exists('activeGuard')) {
    function activeGuard(): string {
        foreach (['admin', 'doctor', 'patient', 'receptionist', 'nurse', 'accountant', 'pharmacist', 'labEmployee', 'rayEmployee'] as $guard) {
            if (auth()->guard($guard)->check()) {
                return $guard;
            }
        }
        return 'admin';
    }
}

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Paginator::useBootstrap();

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}


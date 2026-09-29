<?php

use App\Http\Controllers\Cruds\RayController;
use App\Http\Controllers\Cruds\RayEmployeeController;
use App\Http\Controllers\Users\RayEmployeeLoginController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::post('rayEmployee/login', [RayEmployeeLoginController::class, 'store'])->name('rayEmployee.login');
    Route::post('rayEmployee/register', [RayEmployeeLoginController::class, 'register'])->name('rayEmployee.register');

    Route::group([
        'prefix' => 'rayEmployee',
        'middleware' => 'auth:rayEmployee',
        'as' => 'rayEmployee.'
    ], function () {
        ################################### Auth ###################################

        Route::get('dashboard', [RayEmployeeLoginController::class, 'index'])->name('dashboard');
        Route::post('logout', [RayEmployeeLoginController::class, 'destroy'])->name('logout');

        ################################### Profile ###################################

        Route::group(['prefix' => 'profile'], function () {
            Route::get('', [RayEmployeeController::class, 'show'])->name('show');
            Route::put('', [RayEmployeeController::class, 'update'])->name('update');
            Route::put('password', [RayEmployeeController::class, 'updatePassword'])->name('update.password');
            Route::delete('', [RayEmployeeController::class, 'destroy'])->name('destroy');
        });

        ################################### Cruds ###################################
        /********************************** Rays **********************************/

        Route::group(['prefix' => 'rays'], function () {
            Route::get('{status}', [RayController::class, 'index'])->name('rays.index');
            Route::put('{ray}/diagnosis', [RayController::class, 'diagnosis'])->name('rays.diagnosis');
            Route::get('{ray}/gallery', [RayController::class, 'gallery'])->name('rays.gallery');
        });
    });
});

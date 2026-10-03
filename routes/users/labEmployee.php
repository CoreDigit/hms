<?php

use App\Http\Controllers\Cruds\LabController;
use App\Http\Controllers\Cruds\LabEmployeeController;
use App\Http\Controllers\Users\LabEmployeeLoginController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('labEmployee/login', [LabEmployeeLoginController::class, 'showLoginForm']);
    Route::post('labEmployee/login', [LabEmployeeLoginController::class, 'store'])->name('labEmployee.login');
    Route::post('labEmployee/register', [LabEmployeeLoginController::class, 'register'])->name('labEmployee.register');

    Route::group([
        'prefix' => 'labEmployee',
        'middleware' => 'auth:labEmployee',
        'as' => 'labEmployee.'
    ], function () {
        ################################### Auth ###################################

        Route::get('dashboard', [LabEmployeeLoginController::class, 'index'])->name('dashboard');
        Route::post('logout', [LabEmployeeLoginController::class, 'destroy'])->name('logout');

        ################################### Profile ###################################

        Route::group(['prefix' => 'profile'], function () {
            Route::get('', [LabEmployeeController::class, 'show'])->name('show');
            Route::put('', [LabEmployeeController::class, 'update'])->name('update');
            Route::put('password', [LabEmployeeController::class, 'updatePassword'])->name('update.password');
            Route::delete('', [LabEmployeeController::class, 'destroy'])->name('destroy');
        });

        ################################### Cruds ###################################
        /********************************** Labs **********************************/

        Route::group(['prefix' => 'labs'], function () {
            Route::get('{status}', [LabController::class, 'index'])->name('labs.index');
            Route::put('{lab}/diagnosis', [LabController::class, 'diagnosis'])->name('labs.diagnosis');
            Route::get('{lab}/gallery', [LabController::class, 'gallery'])->name('labs.gallery');
        });
    });
});

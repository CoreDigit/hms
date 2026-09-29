<?php

use App\Http\Controllers\Users\NurseLoginController;
use App\Http\Controllers\Cruds\NurseWorkflowController;
use App\Http\Controllers\Cruds\BedController;
use App\Http\Controllers\Cruds\AdmissionController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::post('nurse/login', [NurseLoginController::class, 'store'])->name('nurse.login');
    Route::post('nurse/register', [NurseLoginController::class, 'register'])->name('nurse.register');

    Route::group([
        'prefix' => 'nurse',
        'middleware' => 'auth:nurse',
    ], function () {
        Route::get('dashboard', [NurseLoginController::class, 'index'])->name('nurse.dashboard');
        Route::post('logout', [NurseLoginController::class, 'destroy'])->name('nurse.logout');

        // Nurse Vitals & Notes
        Route::get('vitals', [NurseWorkflowController::class, 'index'])->name('nurse.vitals.index');
        Route::post('vitals', [NurseWorkflowController::class, 'storeVitals'])->name('nurse.vitals.store');
        Route::post('notes', [NurseWorkflowController::class, 'storeNote'])->name('nurse.notes.store');

        // IPD Beds & Ward view
        Route::get('beds', [BedController::class, 'index'])->name('nurse.beds.index');
        Route::get('admissions', [AdmissionController::class, 'index'])->name('nurse.admissions.index');
    });
});

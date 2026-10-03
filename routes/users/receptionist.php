<?php

use App\Http\Controllers\Users\ReceptionistLoginController;
use App\Http\Controllers\Cruds\PatientController;
use App\Http\Controllers\Cruds\OpdTokenController;
use App\Http\Controllers\Cruds\AdmissionController;
use App\Http\Controllers\Cruds\BedController;
use App\Http\Controllers\Cruds\AppointmentController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('receptionist/login', [ReceptionistLoginController::class, 'showLoginForm']);
    Route::post('receptionist/login', [ReceptionistLoginController::class, 'store'])->name('receptionist.login');
    Route::post('receptionist/register', [ReceptionistLoginController::class, 'register'])->name('receptionist.register');

    Route::group([
        'prefix' => 'receptionist',
        'middleware' => 'auth:receptionist',
        'as' => 'receptionist.',
    ], function () {
        Route::get('dashboard', [ReceptionistLoginController::class, 'index'])->name('dashboard');
        Route::post('logout', [ReceptionistLoginController::class, 'destroy'])->name('logout');

        // Patients & Registration
        Route::resource('patients', PatientController::class);

        // OPD Queue & Tokens
        Route::get('opd-tokens', [OpdTokenController::class, 'index'])->name('opd_tokens.index');
        Route::get('opd-tokens/create', [OpdTokenController::class, 'create'])->name('opd_tokens.create');
        Route::post('opd-tokens', [OpdTokenController::class, 'store'])->name('opd_tokens.store');
        Route::post('opd-tokens/{id}/status', [OpdTokenController::class, 'updateStatus'])->name('opd_tokens.status');
        Route::get('opd-tokens/queue', [OpdTokenController::class, 'queueScreen'])->name('opd_tokens.queue');
        Route::get('opd-tokens/{id}/print', [OpdTokenController::class, 'printSlip'])->name('opd_tokens.print');

        // IPD Admissions & Beds
        Route::get('admissions', [AdmissionController::class, 'index'])->name('admissions.index');
        Route::get('admissions/create', [AdmissionController::class, 'create'])->name('admissions.create');
        Route::post('admissions', [AdmissionController::class, 'store'])->name('admissions.store');
        Route::post('admissions/{id}/discharge', [AdmissionController::class, 'discharge'])->name('admissions.discharge');
        Route::post('admissions/{id}/transfer', [AdmissionController::class, 'transfer'])->name('admissions.transfer');
        Route::get('beds', [BedController::class, 'index'])->name('beds.index');
        Route::post('beds/{id}/status', [BedController::class, 'updateStatus'])->name('beds.status');
        Route::post('wards', [BedController::class, 'storeWard'])->name('wards.store');
        Route::post('beds', [BedController::class, 'storeBed'])->name('beds.store');
    });
});

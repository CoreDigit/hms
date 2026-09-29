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

    Route::post('receptionist/login', [ReceptionistLoginController::class, 'store'])->name('receptionist.login');
    Route::post('receptionist/register', [ReceptionistLoginController::class, 'register'])->name('receptionist.register');

    Route::group([
        'prefix' => 'receptionist',
        'middleware' => 'auth:receptionist',
    ], function () {
        Route::get('dashboard', [ReceptionistLoginController::class, 'index'])->name('receptionist.dashboard');
        Route::post('logout', [ReceptionistLoginController::class, 'destroy'])->name('receptionist.logout');

        // Patients & Registration
        Route::resource('patients', PatientController::class);

        // OPD Queue & Tokens
        Route::get('opd-tokens', [OpdTokenController::class, 'index'])->name('receptionist.opd_tokens.index');
        Route::get('opd-tokens/create', [OpdTokenController::class, 'create'])->name('receptionist.opd_tokens.create');
        Route::post('opd-tokens', [OpdTokenController::class, 'store'])->name('receptionist.opd_tokens.store');
        Route::get('opd-tokens/queue', [OpdTokenController::class, 'queueScreen'])->name('receptionist.opd_tokens.queue');
        Route::get('opd-tokens/{id}/print', [OpdTokenController::class, 'printSlip'])->name('receptionist.opd_tokens.print');

        // IPD Admissions & Beds
        Route::get('admissions', [AdmissionController::class, 'index'])->name('receptionist.admissions.index');
        Route::get('admissions/create', [AdmissionController::class, 'create'])->name('receptionist.admissions.create');
        Route::post('admissions', [AdmissionController::class, 'store'])->name('receptionist.admissions.store');
        Route::get('beds', [BedController::class, 'index'])->name('receptionist.beds.index');
    });
});

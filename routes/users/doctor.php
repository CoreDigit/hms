<?php

use App\Http\Controllers\Users\DoctorLoginController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Cruds\AppointmentController;
use App\Http\Controllers\Cruds\DiagnosticController;
use App\Http\Controllers\Cruds\DoctorController;
use App\Http\Controllers\Cruds\LabController;
use App\Http\Controllers\Cruds\PatientController;
use App\Http\Controllers\Cruds\RayController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::post('doctor/login', [DoctorLoginController::class, 'store'])->name('doctor.login');
    Route::post('doctor/register', [DoctorLoginController::class, 'register'])->name('doctor.register');

    Route::group([
        'prefix' => 'doctor',
        'middleware' => 'auth:doctor',
        'as' => 'doctor.'
    ], function () {
        ################################### Auth ###################################

        Route::get('dashboard', [DoctorLoginController::class, 'index'])->name('dashboard');
        Route::post('logout', [DoctorLoginController::class, 'destroy'])->name('logout');

        ################################### Profile ###################################

        Route::group(['prefix' => 'profile'], function () {
            Route::get('', [DoctorController::class, 'show'])->name('show');
            Route::put('', [DoctorController::class, 'update'])->name('update');
            Route::put('password', [DoctorController::class, 'updatePassword'])->name('update.password');
            Route::delete('', [DoctorController::class, 'destroy'])->name('destroy');
        });

        ################################### Cruds ###################################
        /********************************** Patients **********************************/

        Route::group(['prefix' => 'patients'], function () {
            Route::get('', [PatientController::class, 'index'])->name('patients.index');
            Route::get('{patient}', [PatientController::class, 'show'])->name('patients.show');
            Route::get('{patient}/records', [PatientController::class, 'showRecords'])->name('patients.records');
        });

        /********************************** Appointments **********************************/

        Route::group(['prefix' => 'appointments'], function () {
            Route::get('{status}', [AppointmentController::class, 'index'])->name('appointments.index');
            Route::put('{appointment}/approve', [AppointmentController::class, 'approve'])->name('appointments.approve');
            Route::put('{appointment}/refuse', [AppointmentController::class, 'refuse'])->name('appointments.refuse');
        });

        /********************************** Diagnostics **********************************/

        Route::group(['prefix' => 'diagnostics'], function () {
            Route::get('{status}', [DiagnosticController::class, 'index'])->name('diagnostics.index');
            Route::put('{diagnostic}/diagnosis', [DiagnosticController::class, 'diagnosis'])->name('diagnostics.diagnosis');
            Route::put('{diagnostic}/redirect-to-ray', [DiagnosticController::class, 'redirectToRay'])->name('diagnostics.redirect-to-ray');
            Route::put('{diagnostic}/redirect-to-lab', [DiagnosticController::class, 'redirectToLab'])->name('diagnostics.redirect-to-lab');
        });

        /********************************** Labs **********************************/

        Route::group(['prefix' => 'labs'], function () {
            Route::get('{lab}/gallery', [LabController::class, 'gallery'])->name('labs.gallery');
        });

        /********************************** Rays **********************************/

        Route::group(['prefix' => 'rays'], function () {
            Route::get('{ray}/gallery', [RayController::class, 'gallery'])->name('rays.gallery');
        });

        /********************************** OPD Tokens, Prescriptions & IPD **********************************/

        Route::get('opd-tokens', [\App\Http\Controllers\Cruds\OpdTokenController::class, 'index'])->name('opd_tokens.index');
        Route::post('opd-tokens/{id}/status', [\App\Http\Controllers\Cruds\OpdTokenController::class, 'updateStatus'])->name('opd_tokens.status');
        Route::get('prescriptions', [\App\Http\Controllers\Cruds\PrescriptionController::class, 'index'])->name('prescriptions.index');
        Route::get('prescriptions/create', [\App\Http\Controllers\Cruds\PrescriptionController::class, 'create'])->name('prescriptions.create');
        Route::post('prescriptions', [\App\Http\Controllers\Cruds\PrescriptionController::class, 'store'])->name('prescriptions.store');
        Route::get('prescriptions/{id}/print', [\App\Http\Controllers\Cruds\PrescriptionController::class, 'printSlip'])->name('prescriptions.print');
        Route::get('discharge-summaries/create', [\App\Http\Controllers\Cruds\DischargeSummaryController::class, 'create'])->name('discharge_summaries.create');
        Route::post('discharge-summaries', [\App\Http\Controllers\Cruds\DischargeSummaryController::class, 'store'])->name('discharge_summaries.store');
    });
});

/**
 * These names I'll not use.
 * It's just to not be like the admin routes file.
 * I just want different urls and different guards.
 */

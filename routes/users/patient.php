<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Cruds\AppointmentController;
use App\Http\Controllers\Cruds\DoctorController;
use App\Http\Controllers\Cruds\LabController;
use App\Http\Controllers\Cruds\MultiServiceController;
use App\Http\Controllers\Cruds\PatientAccountController;
use App\Http\Controllers\Cruds\PatientController;
use App\Http\Controllers\Cruds\SingleServiceController;
use App\Http\Controllers\Users\PatientLoginController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::post('patient/login', [PatientLoginController::class, 'store'])->name('patient.login');
    Route::post('patient/register', [PatientLoginController::class, 'register'])->name('patient.register');

    Route::group([
        'prefix' => 'patient',
        'middleware' => 'auth:patient',
        'as' => 'patient.'
    ], function () {
        ################################### Auth ###################################

        Route::get('dashboard', [PatientLoginController::class, 'index'])->name('dashboard');
        Route::post('logout', [PatientLoginController::class, 'destroy'])->name('logout');

        ################################### Profile ###################################

        Route::group(['prefix' => 'profile'], function () {
            Route::get('', [PatientController::class, 'show'])->name('show');
            Route::put('', [PatientController::class, 'update'])->name('update');
            Route::put('password', [PatientController::class, 'updatePassword'])->name('update.password');
            Route::delete('', [PatientController::class, 'destroy'])->name('destroy');
            Route::get('records', [PatientController::class, 'showRecords'])->name('records');
        });

        ################################### Cruds ###################################
        /********************************** Doctors **********************************/

        Route::group(['prefix' => 'doctors'], function () {
            Route::get('', [DoctorController::class, 'index'])->name('doctors.index');
            Route::get('{doctor}', [DoctorController::class, 'show'])->name('doctors.show');
        });

        /********************************** Single Services **********************************/

        Route::group(['prefix' => 'single-services'], function () {
            Route::get('', [SingleServiceController::class, 'index'])->name('single-services.index');
        });

        /********************************** Mutli Services **********************************/

        Route::group(['prefix' => 'mutli-services'], function () {
            Route::get('', [MultiServiceController::class, 'index'])->name('multi-services.index');
        });

        /********************************** Appointments **********************************/

        Route::group(['prefix' => 'appointments'], function () {
            Route::get('{status}', [AppointmentController::class, 'index'])->name('appointments.index');
            Route::post('', [AppointmentController::class, 'store'])->name('appointments.store');
            Route::post('{doctor}', [AppointmentController::class, 'storeWithDoctor'])->name('appointments.store.with.doctor');
        });

        /********************************** Paient Accounts **********************************/

        Route::group(['prefix' => 'accounts'], function () {
            Route::get('', [PatientAccountController::class, 'index'])->name('accounts.index');
            Route::get('{patient_account}', [PatientAccountController::class, 'show'])->name('accounts.show');
        });
    });
});

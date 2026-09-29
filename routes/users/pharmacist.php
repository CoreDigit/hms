<?php

use App\Http\Controllers\Users\PharmacistLoginController;
use App\Http\Controllers\Cruds\PharmacyController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::post('pharmacist/login', [PharmacistLoginController::class, 'store'])->name('pharmacist.login');
    Route::post('pharmacist/register', [PharmacistLoginController::class, 'register'])->name('pharmacist.register');

    Route::group([
        'prefix' => 'pharmacist',
        'middleware' => 'auth:pharmacist',
    ], function () {
        Route::get('dashboard', [PharmacistLoginController::class, 'index'])->name('pharmacist.dashboard');
        Route::post('logout', [PharmacistLoginController::class, 'destroy'])->name('pharmacist.logout');

        // Medicines Stock
        Route::get('medicines', [PharmacyController::class, 'medicinesIndex'])->name('pharmacist.medicines.index');
        Route::post('medicines', [PharmacyController::class, 'storeMedicine'])->name('pharmacist.medicines.store');

        // Pharmacy POS Billing
        Route::get('pos', [PharmacyController::class, 'pos'])->name('pharmacist.pos');
        Route::post('pos/invoice', [PharmacyController::class, 'storeInvoice'])->name('pharmacist.pos.store');
        Route::get('invoices', [PharmacyController::class, 'invoicesIndex'])->name('pharmacist.invoices.index');
        Route::get('invoices/{id}/print', [PharmacyController::class, 'printInvoice'])->name('pharmacist.invoices.print');
    });
});

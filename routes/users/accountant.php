<?php

use App\Http\Controllers\Users\AccountantLoginController;
use App\Http\Controllers\Cruds\ExpenseController;
use App\Http\Controllers\Cruds\InvoiceController;
use App\Http\Controllers\Cruds\PaymentController;
use App\Http\Controllers\Cruds\ReceiptController;
use App\Http\Controllers\Cruds\SingleServiceController;
use App\Http\Controllers\Cruds\MultiServiceController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('accountant/login', [AccountantLoginController::class, 'showLoginForm']);
    Route::post('accountant/login', [AccountantLoginController::class, 'store'])->name('accountant.login');
    Route::post('accountant/register', [AccountantLoginController::class, 'register'])->name('accountant.register');

    Route::group([
        'prefix' => 'accountant',
        'middleware' => 'auth:accountant',
        'as' => 'accountant.',
    ], function () {
        Route::get('dashboard', [AccountantLoginController::class, 'index'])->name('dashboard');
        Route::post('logout', [AccountantLoginController::class, 'destroy'])->name('logout');

        // Expenses & Cash Closing
        Route::get('expenses', [ExpenseController::class, 'index'])->name('expenses.index');
        Route::post('expenses', [ExpenseController::class, 'storeExpense'])->name('expenses.store');
        Route::post('expense-categories', [ExpenseController::class, 'storeCategory'])->name('expenses.category.store');
        Route::get('cash-closing', [ExpenseController::class, 'cashClosingIndex'])->name('cash_closing.index');
        Route::post('cash-closing', [ExpenseController::class, 'storeCashClosing'])->name('cash_closing.store');

        // Invoices
        Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');
        Route::post('invoices', [InvoiceController::class, 'store'])->name('invoices.store');
        Route::put('invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
        Route::post('invoices/{invoice}/auth-destroy', [InvoiceController::class, 'authDestroy'])->name('invoices.auth.destroy');

        // Payments
        Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::put('payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
        Route::post('payments/{payment}/auth-destroy', [PaymentController::class, 'authDestroy'])->name('payments.auth.destroy');

        // Receipts
        Route::get('receipts', [ReceiptController::class, 'index'])->name('receipts.index');
        Route::post('receipts', [ReceiptController::class, 'store'])->name('receipts.store');
        Route::put('receipts/{receipt}', [ReceiptController::class, 'update'])->name('receipts.update');
        Route::post('receipts/{receipt}/auth-destroy', [ReceiptController::class, 'authDestroy'])->name('receipts.auth.destroy');

        // Services
        Route::get('single-services', [SingleServiceController::class, 'index'])->name('single-services.index');
        Route::get('multi-services', [MultiServiceController::class, 'index'])->name('multi-services.index');
    });
});

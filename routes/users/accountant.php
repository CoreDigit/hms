<?php

use App\Http\Controllers\Users\AccountantLoginController;
use App\Http\Controllers\Cruds\ExpenseController;
use App\Http\Controllers\Cruds\InvoiceController;
use App\Http\Controllers\Cruds\PaymentController;
use App\Http\Controllers\Cruds\ReceiptController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::post('accountant/login', [AccountantLoginController::class, 'store'])->name('accountant.login');
    Route::post('accountant/register', [AccountantLoginController::class, 'register'])->name('accountant.register');

    Route::group([
        'prefix' => 'accountant',
        'middleware' => 'auth:accountant',
    ], function () {
        Route::get('dashboard', [AccountantLoginController::class, 'index'])->name('accountant.dashboard');
        Route::post('logout', [AccountantLoginController::class, 'destroy'])->name('accountant.logout');

        // Expenses & Cash Closing
        Route::get('expenses', [ExpenseController::class, 'index'])->name('accountant.expenses.index');
        Route::post('expenses', [ExpenseController::class, 'storeExpense'])->name('accountant.expenses.store');
        Route::post('expense-categories', [ExpenseController::class, 'storeCategory'])->name('accountant.expenses.category.store');
        Route::get('cash-closing', [ExpenseController::class, 'cashClosingIndex'])->name('accountant.cash_closing.index');
        Route::post('cash-closing', [ExpenseController::class, 'storeCashClosing'])->name('accountant.cash_closing.store');

        // Invoices & Payments
        Route::get('invoices', [InvoiceController::class, 'index'])->name('accountant.invoices.index');
        Route::get('payments', [PaymentController::class, 'index'])->name('accountant.payments.index');
        Route::get('receipts', [ReceiptController::class, 'index'])->name('accountant.receipts.index');
    });
});

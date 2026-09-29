<?php

use App\Http\Controllers\cruds\AdminController;
use App\Http\Controllers\Cruds\AmbulanceController;
use App\Http\Controllers\Users\AdminLoginController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Cruds\AmbulanceDriverController;
use App\Http\Controllers\Cruds\AppointmentController;
use App\Http\Controllers\Cruds\DiagnosticController;
use App\Http\Controllers\Cruds\DoctorController;
use App\Http\Controllers\Cruds\FundAccountController;
use App\Http\Controllers\Cruds\InsuranceController;
use App\Http\Controllers\Cruds\InvoiceController;
use App\Http\Controllers\Cruds\LabController;
use App\Http\Controllers\Cruds\LabEmployeeController;
use App\Http\Controllers\Cruds\MultiServiceController;
use App\Http\Controllers\Cruds\PatientAccountController;
use App\Http\Controllers\Cruds\PatientController;
use App\Http\Controllers\Cruds\PaymentController;
use App\Http\Controllers\Cruds\RayController;
use App\Http\Controllers\Cruds\RayEmployeeController;
use App\Http\Controllers\Cruds\ReceiptController;
use App\Http\Controllers\Cruds\SingleServiceController;
use App\Http\Controllers\Cruds\DepartmentController;
use App\Livewire\Cruds\MultiServices\CreateMultiService;
use App\Livewire\Cruds\MultiServices\UpdateMultiService;
use Livewire\Livewire;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::post('admin/login', [AdminLoginController::class, 'store'])->name('admin.login');
    Route::post('admin/register', [AdminLoginController::class, 'register'])->name('admin.register');

    Route::group([
        'prefix' => 'admin',
        'middleware' => 'auth:admin',
    ], function () {
        ################################### Auth ###################################

        Route::get('dashboard', [AdminLoginController::class, 'index'])->name('admin.dashboard');
        Route::post('logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');

        ################################### Profile ###################################

        Route::group(['prefix' => 'profile'], function () {
            Route::get('', [AdminController::class, 'show'])->name('admin.show');
            Route::put('', [AdminController::class, 'update'])->name('admin.update');
            Route::put('password', [AdminController::class, 'updatePassword'])->name('admin.update.password');
            Route::delete('', [AdminController::class, 'destroy'])->name('admin.destroy');
        });

        ################################### Users ###################################
        /********************************** Doctors **********************************/

        Route::resource('doctors', DoctorController::class);
        Route::put('doctors/{doctor}/password', [DoctorController::class, 'updatePassword'])->name('doctors.update.password');
        Route::put('doctors/{doctor}/activate', [DoctorController::class, 'activate'])->name('doctors.activate');
        Route::put('doctors/{doctor}/inactivate', [DoctorController::class, 'inactivate'])->name('doctors.inactivate');

        /********************************** Patients **********************************/

        Route::resource('patients', PatientController::class);
        Route::put('patients/{patient}/password', [PatientController::class, 'updatePassword'])->name('patients.update.password');
        Route::get('patients/{patient}/records', [PatientController::class, 'showRecords'])->name('patients.records');
        Route::post('patients/{patient}/accounts', [PatientController::class, 'showAccounts'])->name('patients.accounts');

        /********************************** Lab Employees **********************************/

        Route::resource('labEmployees', LabEmployeeController::class);
        Route::put('labEmployees/{labEmployee}/password', [LabEmployeeController::class, 'updatePassword'])->name('labEmployees.update.password');
        Route::put('labEmployees/{labEmployee}/activate', [LabEmployeeController::class, 'activate'])->name('labEmployees.activate');
        Route::put('labEmployees/{labEmployee}/inactivate', [LabEmployeeController::class, 'inactivate'])->name('labEmployees.inactivate');

        /********************************** Ray Employees **********************************/

        Route::resource('rayEmployees', RayEmployeeController::class);
        Route::put('rayEmployees/{rayEmployee}/password', [RayEmployeeController::class, 'updatePassword'])->name('rayEmployees.update.password');
        Route::put('rayEmployees/{rayEmployee}/activate', [RayEmployeeController::class, 'activate'])->name('rayEmployees.activate');
        Route::put('rayEmployees/{rayEmployee}/inactivate', [RayEmployeeController::class, 'inactivate'])->name('rayEmployees.inactivate');

        /********************************** Amulance Drivers **********************************/

        Route::resource('ambulanceDrivers', AmbulanceDriverController::class);
        Route::put('ambulanceDrivers/{ambulanceDriver}/activate', [AmbulanceDriverController::class, 'activate'])->name('ambulanceDrivers.activate');
        Route::put('ambulanceDrivers/{ambulanceDriver}/inactivate', [AmbulanceDriverController::class, 'inactivate'])->name('ambulanceDrivers.inactivate');

        ################################### Cruds ###################################
        /********************************** Single Services **********************************/

        Route::group(['prefix' => 'single-services'], function () {
            Route::get('', [SingleServiceController::class, 'index'])->name('single-services.index');
            Route::post('', [SingleServiceController::class, 'store'])->name('single-services.store');
            Route::put('{single_service}', [SingleServiceController::class, 'update'])->name('single-services.update');
            Route::delete('{single_service}', [SingleServiceController::class, 'destroy'])->name('single-services.destroy');
            Route::post('destroy-group', [SingleServiceController::class, 'destroyGroup'])->name('single-services.destroy-group');
            Route::put('{single_service}/activate', [SingleServiceController::class, 'activate'])->name('single-services.activate');
            Route::put('{single_service}/inactivate', [SingleServiceController::class, 'inactivate'])->name('single-services.inactivate');
        });

        /********************************** Mutli Services **********************************/

        Route::group(['prefix' => 'mutli-services'], function () {
            Route::get('', [MultiServiceController::class, 'index'])->name('multi-services.index');
            Route::put('{multi_service}', [MultiServiceController::class, 'update'])->name('multi-services.update');
            Route::delete('{multi_service}', [MultiServiceController::class, 'destroy'])->name('multi-services.destroy');
            Route::post('destroy-group', [MultiServiceController::class, 'destroyGroup'])->name('multi-services.destroy-group');
            Route::put('{multi_service}/activate', [MultiServiceController::class, 'activate'])->name('multi-services.activate');
            Route::put('{multi_service}/inactivate', [MultiServiceController::class, 'inactivate'])->name('multi-services.inactivate');
                
            Route::get('create', CreateMultiService::class)->name('multi-services.create');
            Route::get('{id}/edit', UpdateMultiService::class)->name('multi-services.edit');
        });

        /********************************** Invoices **********************************/

        Route::group(['prefix' => 'invoices'], function () {
            Route::get('', [InvoiceController::class, 'index'])->name('invoices.index');
            Route::post('', [InvoiceController::class, 'store'])->name('invoices.store');
            Route::get('{invoice}', [invoiceController::class, 'show'])->name('invoices.show');
            Route::put('{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
            Route::put('auth/{invoice}', [InvoiceController::class, 'authDestroy'])->name('invoices.auth.destroy');
        });

        /********************************** Receipts **********************************/

        Route::group(['prefix' => 'receipts'], function () {
            Route::get('', [ReceiptController::class, 'index'])->name('receipts.index');
            Route::post('', [ReceiptController::class, 'store'])->name('receipts.store');
            Route::get('{receipt}', [ReceiptController::class, 'show'])->name('receipts.show');
            Route::put('{receipt}', [ReceiptController::class, 'update'])->name('receipts.update');
            Route::put('{receipt}/auth/destroy', [ReceiptController::class, 'authDestroy'])->name('receipts.auth.destroy');
        });

        /********************************** Payments **********************************/

        Route::group(['prefix' => 'payments'], function () {
            Route::get('', [PaymentController::class, 'index'])->name('payments.index');
            Route::post('', [PaymentController::class, 'store'])->name('payments.store');
            Route::get('{payment}', [PaymentController::class, 'show'])->name('payments.show');
            Route::put('{payment}', [PaymentController::class, 'update'])->name('payments.update');
            Route::put('{payment}/auth/destroy', [PaymentController::class, 'authDestroy'])->name('payments.auth.destroy');
        });

        /********************************** Paient Accounts **********************************/

        Route::group(['prefix' => 'patient-accounts'], function () {
            Route::get('', [PatientAccountController::class, 'index'])->name('patient-accounts.index');
            Route::get('{patient_account}', [PatientAccountController::class, 'show'])->name('patient-accounts.show');
        });

        /********************************** Fund Accounts **********************************/

        Route::group(['prefix' => 'fund-accounts'], function () {
            Route::get('', [FundAccountController::class, 'index'])->name('fund-accounts.index');
            Route::get('{fund_account}', [FundAccountController::class, 'show'])->name('fund-accounts.show');
            Route::post('', [FundAccountController::class, 'showAll'])->name('fund-accounts.all');
        });

        /********************************** Appointments **********************************/

        Route::group(['prefix' => 'appointments'], function () {
            Route::get('{status?}', [AppointmentController::class, 'index'])->name('appointments.index');
        });

        /********************************** Diagnostics **********************************/

        Route::group(['prefix' => 'diagnostics'], function () {
            Route::get('{status?}', [DiagnosticController::class, 'index'])->name('diagnostics.index');
        });

        /********************************** Labs **********************************/

        Route::group(['prefix' => 'labs'], function () {
            Route::get('{status?}', [LabController::class, 'index'])->name('labs.index');
        });

        /********************************** Rays **********************************/

        Route::group(['prefix' => 'rays'], function () {
            Route::get('{status?}', [RayController::class, 'index'])->name('rays.index');
        });

        /********************************** Departments **********************************/

        Route::group(['prefix' => 'departments'], function () {
            Route::get('', [DepartmentController::class, 'index'])->name('departments.index');
            Route::post('', [DepartmentController::class, 'store'])->name('departments.store');
            Route::put('{department}', [DepartmentController::class, 'update'])->name('departments.update');
            Route::delete('{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
            Route::post('destroy-group', [DepartmentController::class, 'destroyGroup'])->name('departments.destroy-group');
        });

        /********************************** Ambulances **********************************/

        Route::group(['prefix' => 'ambulances'], function () {
            Route::get('', [AmbulanceController::class, 'index'])->name('ambulances.index');
            Route::post('', [AmbulanceController::class, 'store'])->name('ambulances.store');
            Route::put('{ambulance}', [AmbulanceController::class, 'update'])->name('ambulances.update');
            Route::delete('{ambulance}', [AmbulanceController::class, 'destroy'])->name('ambulances.destroy');
            Route::post('destroy-group', [AmbulanceController::class, 'destroyGroup'])->name('ambulances.destroy-group');
            Route::put('{ambulance}/activate', [AmbulanceController::class, 'activate'])->name('ambulances.activate');
            Route::put('{ambulance}/inactivate', [AmbulanceController::class, 'inactivate'])->name('ambulances.inactivate');
        });

        /********************************** Insurances **********************************/

        Route::group(['prefix' => 'insurances'], function () {
            Route::get('', [InsuranceController::class, 'index'])->name('insurances.index');
            Route::post('', [InsuranceController::class, 'store'])->name('insurances.store');
            Route::put('{insurance}', [InsuranceController::class, 'update'])->name('insurances.update');
            Route::delete('{insurance}', [InsuranceController::class, 'destroy'])->name('insurances.destroy');
            Route::post('destroy-group', [InsuranceController::class, 'destroyGroup'])->name('insurances.destroy-group');
            Route::put('{insurance}/activate', [InsuranceController::class, 'activate'])->name('insurances.activate');
            Route::put('{insurance}/inactivate', [InsuranceController::class, 'inactivate'])->name('insurances.inactivate');
        });

        /********************************** OPD Tokens & Queue **********************************/

        Route::get('opd-tokens', [\App\Http\Controllers\Cruds\OpdTokenController::class, 'index'])->name('opd_tokens.index');
        Route::get('opd-tokens/create', [\App\Http\Controllers\Cruds\OpdTokenController::class, 'create'])->name('opd_tokens.create');
        Route::post('opd-tokens', [\App\Http\Controllers\Cruds\OpdTokenController::class, 'store'])->name('opd_tokens.store');
        Route::post('opd-tokens/{id}/status', [\App\Http\Controllers\Cruds\OpdTokenController::class, 'updateStatus'])->name('opd_tokens.status');
        Route::get('opd-tokens/queue', [\App\Http\Controllers\Cruds\OpdTokenController::class, 'queueScreen'])->name('opd_tokens.queue');
        Route::get('opd-tokens/{id}/print', [\App\Http\Controllers\Cruds\OpdTokenController::class, 'printSlip'])->name('opd_tokens.print');

        /********************************** Wards & Beds **********************************/

        Route::get('beds', [\App\Http\Controllers\Cruds\BedController::class, 'index'])->name('beds.index');
        Route::post('wards', [\App\Http\Controllers\Cruds\BedController::class, 'storeWard'])->name('wards.store');
        Route::post('beds', [\App\Http\Controllers\Cruds\BedController::class, 'storeBed'])->name('beds.store');
        Route::post('beds/{id}/status', [\App\Http\Controllers\Cruds\BedController::class, 'updateStatus'])->name('beds.status');

        /********************************** IPD Admissions **********************************/

        Route::get('admissions', [\App\Http\Controllers\Cruds\AdmissionController::class, 'index'])->name('admissions.index');
        Route::get('admissions/create', [\App\Http\Controllers\Cruds\AdmissionController::class, 'create'])->name('admissions.create');
        Route::post('admissions', [\App\Http\Controllers\Cruds\AdmissionController::class, 'store'])->name('admissions.store');
        Route::post('admissions/{id}/transfer', [\App\Http\Controllers\Cruds\AdmissionController::class, 'transfer'])->name('admissions.transfer');
        Route::post('admissions/{id}/discharge', [\App\Http\Controllers\Cruds\AdmissionController::class, 'discharge'])->name('admissions.discharge');

        /********************************** Prescriptions **********************************/

        Route::get('prescriptions', [\App\Http\Controllers\Cruds\PrescriptionController::class, 'index'])->name('prescriptions.index');
        Route::get('prescriptions/create', [\App\Http\Controllers\Cruds\PrescriptionController::class, 'create'])->name('prescriptions.create');
        Route::post('prescriptions', [\App\Http\Controllers\Cruds\PrescriptionController::class, 'store'])->name('prescriptions.store');
        Route::get('prescriptions/{id}', [\App\Http\Controllers\Cruds\PrescriptionController::class, 'show'])->name('prescriptions.show');
        Route::get('prescriptions/{id}/print', [\App\Http\Controllers\Cruds\PrescriptionController::class, 'printSlip'])->name('prescriptions.print');

        /********************************** Nurse Vitals & Notes **********************************/

        Route::get('nurse/vitals', [\App\Http\Controllers\Cruds\NurseWorkflowController::class, 'index'])->name('nurse_vitals.index');
        Route::post('nurse/vitals', [\App\Http\Controllers\Cruds\NurseWorkflowController::class, 'storeVitals'])->name('nurse_vitals.store');
        Route::post('nurse/notes', [\App\Http\Controllers\Cruds\NurseWorkflowController::class, 'storeNote'])->name('nurse_notes.store');

        /********************************** Discharge Summaries **********************************/

        Route::get('discharge-summaries', [\App\Http\Controllers\Cruds\DischargeSummaryController::class, 'index'])->name('discharge_summaries.index');
        Route::get('discharge-summaries/create', [\App\Http\Controllers\Cruds\DischargeSummaryController::class, 'create'])->name('discharge_summaries.create');
        Route::post('discharge-summaries', [\App\Http\Controllers\Cruds\DischargeSummaryController::class, 'store'])->name('discharge_summaries.store');
        Route::get('discharge-summaries/{id}/print', [\App\Http\Controllers\Cruds\DischargeSummaryController::class, 'printSlip'])->name('discharge_summaries.print');

        /********************************** Pharmacy & Medicines **********************************/

        Route::get('pharmacy/medicines', [\App\Http\Controllers\Cruds\PharmacyController::class, 'medicinesIndex'])->name('pharmacy.medicines.index');
        Route::post('pharmacy/medicines', [\App\Http\Controllers\Cruds\PharmacyController::class, 'storeMedicine'])->name('pharmacy.medicines.store');
        Route::get('pharmacy/pos', [\App\Http\Controllers\Cruds\PharmacyController::class, 'pos'])->name('pharmacy.pos');
        Route::post('pharmacy/pos/invoice', [\App\Http\Controllers\Cruds\PharmacyController::class, 'storeInvoice'])->name('pharmacy.pos.store');
        Route::get('pharmacy/invoices', [\App\Http\Controllers\Cruds\PharmacyController::class, 'invoicesIndex'])->name('pharmacy.invoices.index');
        Route::get('pharmacy/invoices/{id}/print', [\App\Http\Controllers\Cruds\PharmacyController::class, 'printInvoice'])->name('pharmacy.invoices.print');

        /********************************** Inventory Management **********************************/

        Route::get('inventory/suppliers', [\App\Http\Controllers\Cruds\InventoryController::class, 'suppliersIndex'])->name('inventory.suppliers.index');
        Route::post('inventory/suppliers', [\App\Http\Controllers\Cruds\InventoryController::class, 'storeSupplier'])->name('inventory.suppliers.store');
        Route::get('inventory/items', [\App\Http\Controllers\Cruds\InventoryController::class, 'itemsIndex'])->name('inventory.items.index');
        Route::post('inventory/items', [\App\Http\Controllers\Cruds\InventoryController::class, 'storeItem'])->name('inventory.items.store');
        Route::post('inventory/items/{id}/stock', [\App\Http\Controllers\Cruds\InventoryController::class, 'updateStock'])->name('inventory.items.stock');

        /********************************** Expenses & Cash Closing **********************************/

        Route::get('expenses', [\App\Http\Controllers\Cruds\ExpenseController::class, 'index'])->name('expenses.index');
        Route::post('expenses', [\App\Http\Controllers\Cruds\ExpenseController::class, 'storeExpense'])->name('expenses.store');
        Route::post('expense-categories', [\App\Http\Controllers\Cruds\ExpenseController::class, 'storeCategory'])->name('expenses.category.store');
        Route::get('cash-closing', [\App\Http\Controllers\Cruds\ExpenseController::class, 'cashClosingIndex'])->name('cash_closing.index');
        Route::post('cash-closing', [\App\Http\Controllers\Cruds\ExpenseController::class, 'storeCashClosing'])->name('cash_closing.store');

        /********************************** Roles & Permissions (RBAC) **********************************/

        Route::get('roles-permissions', [\App\Http\Controllers\Cruds\RolePermissionController::class, 'index'])->name('roles_permissions.index');
        Route::post('roles', [\App\Http\Controllers\Cruds\RolePermissionController::class, 'storeRole'])->name('roles.store');
        Route::post('roles/{id}/permissions', [\App\Http\Controllers\Cruds\RolePermissionController::class, 'updateRolePermissions'])->name('roles.permissions.update');

        /********************************** Universal Print Templates **********************************/

        Route::get('print/patient-card/{id}', [\App\Http\Controllers\Cruds\PrintTemplateController::class, 'patientIdCard'])->name('print.patient_card');
        Route::get('print/opd-slip/{id}', [\App\Http\Controllers\Cruds\PrintTemplateController::class, 'opdTokenSlip'])->name('print.opd_slip');
        Route::get('print/prescription/{id}', [\App\Http\Controllers\Cruds\PrintTemplateController::class, 'prescriptionSlip'])->name('print.prescription');
        Route::get('print/pharmacy-receipt/{id}', [\App\Http\Controllers\Cruds\PrintTemplateController::class, 'pharmacyReceipt'])->name('print.pharmacy_receipt');
        Route::get('print/discharge-summary/{id}', [\App\Http\Controllers\Cruds\PrintTemplateController::class, 'dischargeSummaryDoc'])->name('print.discharge_summary');
        Route::get('print/payment-receipt/{id}', [\App\Http\Controllers\Cruds\PrintTemplateController::class, 'paymentReceiptDoc'])->name('print.payment_receipt');
    });
});

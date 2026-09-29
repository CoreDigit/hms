<?php

use App\Http\Controllers\Cruds\DoctorController;
use App\Http\Controllers\Cruds\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\IndexController;
use App\Livewire\Web\IndexMultiServices;
use App\Livewire\Web\IndexSingleServices;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    ################################### Auth #######################################

    require __DIR__ . '/auth.php';

    ################################### Web #######################################

    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    }); // To: make livewire work with mcamara laravel localization

    Route::group(['as' => 'web.'], function () {
        ################################### Index #######################################
        /********************************** Home **********************************/

        Route::get('/', [IndexController::class, 'index'])->name('index');

        /********************************** Services **********************************/

        Route::get('services', [IndexController::class, 'indexServices'])->name('services.index');
        Route::get('single-services', IndexSingleServices::class)->name('single.services.index');
        Route::get('multi-services', IndexMultiServices::class)->name('multi.services.index');
        Route::get('multi-services/{multi_service}', [IndexController::class, 'showMultiService'])->name('multi.services.show');

        /********************************** Appointments **********************************/
        
        Route::get('appointments', [IndexController::class, 'createAppointment'])->name('appointments.create');

        /********************************** Contact **********************************/

        Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
            Route::get('', [IndexController::class, 'createContact'])->name('create');
            Route::post('', [IndexController::class, 'storeContact'])->name('store');
        });

        /********************************** About **********************************/

        Route::group(['prefix' => 'about', 'as' => 'about.'], function () {
            Route::get('us', [IndexController::class, 'showAbout'])->name('us');
            Route::get('faq', [IndexController::class, 'showFaq'])->name('faq');
            Route::post('ask', [IndexController::class, 'storeAsk'])->name('ask');
        });

        ################################### Cruds #######################################
        /********************************** Doctors **********************************/

        Route::group(['prefix' => 'doctors', 'as' => 'doctors.'], function () {
            Route::get('', [DoctorController::class, 'webIndex'])->name('index');
            Route::get('{doctor}', [DoctorController::class, 'webShow'])->name('show');
        });

        /********************************** Departments **********************************/

        Route::group(['prefix' => 'departments', 'as' => 'departments.'], function () {
            Route::get('', [DepartmentController::class, 'webIndex'])->name('index');
            Route::get('{department}', [DepartmentController::class, 'webShow'])->name('show');
        });
    });
});

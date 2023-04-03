<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientAddressController;
use App\Http\Controllers\RevenueController;
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

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' =>['auth','role:admin']],function(){
    Route::get('/admin', function () { return view('Admin/index'); })->name('admin.index');
    Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('pharmacies.index');
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/revenues', [RevenueController::class, 'index'])->name('revenues.index');
    Route::get('/patientsAddresses', [PatientAddressController::class, 'index'])->name('patientsAddress.index');
    Route::get('/pharmacies/create', [PharmacyController::class, 'create'])->name('pharmacies.create');
    Route::get('/areas/create', [AreaController::class, 'create'])->name('areas.create');
    Route::post('/pharmacies', [PharmacyController::class, 'store'])->name('pharmacies.store');
    Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');
    Route::get('/pharmacies/{id}/edit', [PharmacyController::class, 'edit'])->name('pharmacies.edit');
    Route::get('/areas/{id}/edit', [AreaController::class, 'edit'])->name('areas.edit');
    Route::put('/pharmacies/{id}', [PharmacyController::class, 'update'])->name('pharmacies.update');
    Route::put('/areas/{id}', [AreaController::class, 'update'])->name('areas.update');
    Route::get('/pharmacies/{post}', [PharmacyController::class, 'show'])->name('pharmacies.show');
    Route::get('/areas/{area}', [AreaController::class, 'show'])->name('areas.show');
    Route::delete('/pharmacies/{id}', [PharmacyController::class, 'destroy'])->name('pharmacies.destroy');
    Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->name('areas.destroy');
    Route::get('/deletedpharmacies', [PharmacyController::class, 'showTrashed'])->name('pharmacies.showTrashed');
    Route::patch('/pharmacies/{id}/restore',[PharmacyController::class, 'restoreTrashedPharmacies'])->name('pharmacies.restoreTrashedPharmacies');
    Route::delete('/pharmacies/{id}/force-delete', [PharmacyController::class, 'forceDeleteTrashedPharmacies'])->name('pharmacies.forceDelete');

});


Route::get('/doctor', function () {
    return view('Doctor/index');
})->middleware(['auth','role:doctor'])->name('doctor.index');

Route::get('/pharmacy', function () {
    return view('Pharmacy/index');
})->middleware(['auth','role:pharmacy'])->name('pharmacy.index');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


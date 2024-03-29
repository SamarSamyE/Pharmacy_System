<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\PharmacyOwnerController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientAddressController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\StripePaymentController;

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



Route::group(['middleware' =>['auth']],function(){

    Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('pharmacies.index');
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/areas', [AreaController::class, 'index'])->name('area.index');
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/revenues', [RevenueController::class, 'index'])->name('revenues.index');
    Route::get('/patientsAddresses', [PatientAddressController::class, 'index'])->name('patientsAddress.index');
    Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');


    Route::get('/pharmacies/create', [PharmacyController::class, 'create'])->name('pharmacies.create');
    // Route::get('/areas/create', [AreaController::class, 'create'])->name('areas.create');
    Route::get('/area/create', [AreaController::class,'create'])->name('area.create');
    Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/medicines/create', [MedicineController::class, 'create'])->name('medicines.create');

    Route::post('/pharmacies', [PharmacyController::class, 'store'])->name('pharmacies.store');
    Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
    Route::post('/areas', [AreaController::class, 'store'])->name('area.store');
    Route::post('/medicines', [MedicineController::class, 'store'])->name('medicines.store');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    Route::get('/pharmacies/{id}/edit', [PharmacyController::class, 'edit'])->name('pharmacies.edit');
    Route::get('/areas/{id}/edit', [AreaController::class, 'edit'])->name('area.edit');
    Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
    Route::get('/medicines/{id}/edit', [MedicineController::class, 'edit'])->name('medicines.edit');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');

    Route::put('/pharmacies/{id}', [PharmacyController::class, 'update'])->name('pharmacies.update');
    Route::put('/doctors/{id}', [DoctorController::class, 'update'])->name('doctors.update');
    Route::put('/areas/{id}', [AreaController::class, 'update'])->name('area.update');
    Route::put('/medicines/{id}', [MedicineController::class, 'update'])->name('medicines.update');
    Route::put('/order/{id}', [OrderController::class, 'update'])->name('orders.update');

    Route::get('/pharmacies/{post}', [PharmacyController::class, 'show'])->name('pharmacies.show');
    Route::get('doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');
    Route::get('/areas/{area}', [AreaController::class, 'show'])->name('area.show');
    Route::get('/medicines/{area}', [MedicineController::class, 'show'])->name('medicines.show');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');
    Route::delete('/orders/{id}/cancelled', [OrderController::class, 'cancel'])->name('orders.cancelled');


    Route::delete('/pharmacies/{id}', [PharmacyController::class, 'destroy'])->name('pharmacies.destroy');
    Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->name('area.destroy');
    Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
    Route::delete('/medicines/{id}', [MedicineController::class, 'destroy'])->name('medicines.destroy');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    Route::get('/deletedpharmacies', [PharmacyController::class, 'showTrashed'])->name('pharmacies.showTrashed');
    Route::patch('/pharmacies/{id}/restore',[PharmacyController::class, 'restoreTrashedPharmacies'])->name('pharmacies.restoreTrashedPharmacies');
    Route::delete('/pharmacies/{id}/force-delete', [PharmacyController::class, 'forceDeleteTrashedPharmacies'])->name('pharmacies.forceDelete');

    Route::post('/ban', [DoctorController::class, 'ban'])->name('doctor.ban');
    Route::post('/unban', [DoctorController::class, 'unban'])->name('doctor.unban');

    // Route::get('stripe', [StripePaymentController::class , 'stripe']);
    Route::get('stripe/{order}', [StripePaymentController::class , 'stripe']);
    Route::post('stripe/{order}', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

});
Route::get('/users', function () {
    return view('Admin/index');
})->middleware(['auth'])->name('admin.index');

Auth::routes(['verify' => true]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



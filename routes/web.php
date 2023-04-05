<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\PharmacyOwnerController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MedicineController;
use App\Http\Middleware\BanMiddleware;

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
    Route::get('/pharmacies/create', [PharmacyController::class, 'create'])->name('pharmacies.create');
    Route::post('/pharmacies', [PharmacyController::class, 'store'])->name('pharmacies.store');
    Route::get('/pharmacies/{id}/edit', [PharmacyController::class, 'edit'])->name('pharmacies.edit');
    Route::put('/pharmacies/{id}', [PharmacyController::class, 'update'])->name('pharmacies.update');
    Route::get('/pharmacies/{post}', [PharmacyController::class, 'show'])->name('pharmacies.show');
    Route::delete('/pharmacies/{id}', [PharmacyController::class, 'destroy'])->name('pharmacies.destroy');
});


Route::get('/doctor', function () {
    return view('Doctor/index');
})->middleware(['auth','role:doctor'])->name('doctor.index');






Route::group(['middleware' =>['auth','role:pharmacy']],function(){
   
Route::get('/pharmacy', function () {
    return view('Pharmacy/index');});
    Route::get('pharmacy/Doctors/create', [PharmacyOwnerController::class, 'create'])->name('Doctors.create');
    Route::post('/pharmacy/Doctors', [PharmacyOwnerController::class, 'store'])->name('Doctors.store');
    Route::get('pharmacy/Doctors', [PharmacyOwnerController::class, 'index'])->name('Doctors.index');
    Route::get('pharmacy/Doctors/{id}', [PharmacyOwnerController::class, 'show'])->name('Doctors.show');
    Route::get('pharmacy/Doctors/edit/{Doctor}', [PharmacyOwnerController::class, 'edit'])->name('Doctors.edit');
    //{}as it allows me send anything
    Route::put('/pharmacy/Doctors/{id}', [PharmacyOwnerController::class, 'update'])->name('Doctors.update');
    Route::delete('pharmacy/Doctors/{id}', [PharmacyOwnerController::class, 'destroy'])->name('Doctors.destroy');

    Route::get('pharmacy/Medicines', [MedicineController::class, 'index'])->name('Medicines.index');
    Route::get('pharmacy/Medicines/create', [MedicineController::class, 'create'])->name('Medicines.create');
    Route::post('/pharmacy/Medicines', [MedicineController::class, 'store'])->name('Medicines.store');
    Route::get('pharmacy/Medicines/{id}', [MedicineController::class, 'show'])->name('Medicines.show');
    Route::get('pharmacy/Medicines/edit/{Medicine}', [MedicineController::class, 'edit'])->name('Medicines.edit');
    Route::put('/pharmacy/Medicines/{id}', [MedicineController::class, 'update'])->name('Medicines.update');
    Route::delete('pharmacy/Medicines/{id}', [MedicineController::class, 'destroy'])->name('Medicines.destroy');


    Route::post('/bans', [PharmacyOwnerController::class, 'ban'])->name('doctor.ban');
    Route::post('/unbans', [PharmacyOwnerController::class, 'unban'])->name('doctor.unban');



});



Route::get('/patient', function () {
    return view('patient');
})->middleware(['auth','role:patient'])->name('patient.index');

Route::group(['name' => 'Orders','prefix' => 'Orders','middleware' =>['role: admin|pharmacy|doctor', 'auth']],function(){
    Route::get('/', [OrderController::class, 'index'])->name('Orders.index');
    Route::get('/create',[OrderController::class, 'create'])->name('Orders.create');
    Route::get('/edit/{Order}',[OrderController::class, 'edit'])->name('Orders.edit');
    Route::get('/show/{id}',[OrderController::class, 'show'])->name('Orders.show');
    Route::post('/', [OrderController::class, 'store'])->name('Orders.store');
    Route::put('/update/{orders}', [OrderController::class, 'update'])->name('Orders.update');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



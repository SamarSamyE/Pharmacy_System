<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::get('/admin', function () {
    return view('Admin/index');
})->middleware(['auth','role:admin'])->name('admin.index');


Route::get('/doctor', function () {
    return view('Doctor/index');
})->middleware(['auth','role:doctor'])->name('doctor.index');

Route::get('/pharmacy', function () {
    return view('Pharmacy/index');
})->middleware(['auth','role:pharmacy'])->name('pharmacy.index');

Route::get('/patient', function () {
    return view('patient');
})->middleware(['auth','role:patient'])->name('patient.index');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


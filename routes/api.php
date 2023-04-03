<?php

use App\Http\Controllers\Api\AddressesController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Resources\PatientResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('/register',[PatientController::class, 'register']);

Route::post('/login', [PatientController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Patient Update
    Route::put('/patient/{id}',[PatientController::class, 'update']);

    //Patient Addresses
    Route::get('/addresses', [AddressesController::class, 'index']);
    Route::get('/address/{id}', [AddressesController::class, 'show']);
    Route::post('/addresses', [AddressesController::class, 'store']);
    Route::put('/address/{id}', [AddressesController::class, 'update']);
    Route::delete('/address/{id}', [AddressesController::class, 'destroy']);
});



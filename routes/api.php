<?php

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
    // protected routes go here
    Route::put('/patient/8',[PatientController::class, 'update']);
});



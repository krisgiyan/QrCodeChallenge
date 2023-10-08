<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TOTPController;
use App\Http\Controllers\TOTPVerificationController;

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

Route::get('/', function () {
    return view('navigation');
});

Route::get('/verify-code', [TOTPVerificationController::class, 'showForm']);
Route::post('/verification', [TOTPVerificationController::class, 'verify']);
Route::get('/show-form', [TOTPVerificationController::class, 'showForm'])->name('show.form');


Route::get('/generate-totp', [TOTPController::class, 'generateTOTPView'])->name('generate.totp.view');
Route::post('/generate-totp', [TOTPController::class, 'generateTOTP'])->name('generate.totp');
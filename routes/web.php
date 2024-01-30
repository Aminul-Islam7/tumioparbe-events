<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\BkashTokenizePaymentController;
use Illuminate\Support\Facades\Route;
use App\Models\Registration;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [RegistrationController::class, 'index'])->name('dashboard');
});


// Homepage (Registration Form)
Route::get('/', [RegistrationController::class, 'create'])->name('home');

// Store Registration Form data
Route::post('/', [RegistrationController::class, 'store']);



// bKash Payment Routes
Route::get('/bkash/payment', [BkashTokenizePaymentController::class,'index']);

Route::post('/bkash/create-payment', [BkashTokenizePaymentController::class,'createPayment'])->name('bkash-create-payment');

Route::get('/bkash/callback', [BkashTokenizePaymentController::class,'callBack'])->name('bkash-callBack');


Route::get('/registration-successful/{payID}', [RegistrationController::class, 'success'])->name('success');

Route::get('/payment-cancelled/{payID}', [RegistrationController::class, 'cancel'])->name('cancelled');

Route::get('/payment-failed/{payID}', [RegistrationController::class, 'failure'])->name('failed');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GetPointController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GetRewardController;
use App\Http\Controllers\HomesFactController;
use App\Http\Controllers\API\V1\OTPController;
use App\Http\Controllers\CustomerVerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. Thdese
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('otp/{phoneNumber}', [OTPController::class, 'getOTP']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::resource('cards', CardController::class)->names('cards');
    Route::resource('rewards', RewardController::class)->names('rewards');

    Route::resource('homes-fact', HomesFactController::class)->names('homesfact');

    Route::resource('customers', CustomerController::class)->names('customers');

    Route::get('waiting-verification', [CustomerVerificationController::class, 'index'])->name('waiting_verificatiton.index');
    Route::get('waiting-verification/{id}/{is_accept}', [CustomerVerificationController::class, 'update'])->name('waiting_verificatiton.update');

    Route::get('get-point', [GetPointController::class, 'create'])->name('get_poin.create');
    Route::post('get-point/store', [GetPointController::class, 'store'])->name('get_poin.store');

    Route::get('get-rewards', [GetRewardController::class, 'create'])->name('get_reward.create');
    Route::post('get-rewards/store', [GetRewardController::class, 'store'])->name('get_reward.store');

    Route::resource('store-management', StoreController::class)->names('store');
});


require __DIR__.'/auth.php';

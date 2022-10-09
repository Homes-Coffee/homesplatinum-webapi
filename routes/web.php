<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::resource('cards', CardController::class)->names('cards');
    Route::resource('rewards', RewardController::class)->names('rewards');

    Route::resource('customers', CustomerController::class);

    Route::get('waiting-verification', [CustomerVerificationController::class, 'index'])->name('waiting_verificatiton.index');
});


require __DIR__.'/auth.php';

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\OTPController;
use App\Http\Controllers\API\V1\CardController;
use App\Http\Controllers\API\V1\HomeController;
use App\Http\Controllers\API\V1\LoginController;
use App\Http\Controllers\API\V1\StoreController;
use App\Http\Controllers\API\V1\WalletController;
use App\Http\Controllers\API\V1\CustomerController;
use App\Http\Controllers\API\V1\RegisterController;
use App\Http\Controllers\API\V1\AgreementController;
use App\Http\Controllers\API\V1\HomesFactController;
use App\Http\Controllers\API\V1\CustomerTransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('agreement/{agreement}', [AgreementController::class, 'show']);
Route::get('stores', [StoreController::class, 'index']);
Route::get('stores/{store}', [StoreController::class, 'show']);

Route::post('register/{type?}', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

Route::post('check-otp', [OTPController::class, 'check_otp']);
Route::post('resend-otp', [OTPController::class, 'resend_otp']);

Route::get('card', [CardController::class, 'index']);
Route::get('homes-fact', [HomesFactController::class, 'index']);

Route::middleware(['auth:sanctum', 'is_active'])->group(function () {

    Route::post('create-pin', [WalletController::class, 'create_pin']);

    Route::middleware(['pin_required'])->group(function () {
        Route::put('change-pin', [WalletController::class, 'change_pin']);
        Route::post('check-pin', [WalletController::class, 'check_pin']);
    });

    Route::middleware(['pin_not_null'])->group(function () {
        Route::get('home', [HomeController::class, 'index']);

        Route::prefix('customer')->group(function () {
            Route::get('/', [CustomerController::class, 'show']);

            Route::put('update-fcm', [CustomerController::class, 'fcm']);
            Route::put('change-image', [CustomerController::class, 'change_image']);
            Route::put('change-profile', [CustomerController::class, 'change_profile']);

            Route::delete('logout', [CustomerController::class, 'logout']);
            Route::delete('delete-account', [CustomerController::class, 'delete_account']);

            Route::get('/transactions', [CustomerTransactionController::class, 'history_transaction']);

        });
    });

});

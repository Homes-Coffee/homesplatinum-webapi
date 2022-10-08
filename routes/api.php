<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\OTPController;
use App\Http\Controllers\API\V1\LoginController;
use App\Http\Controllers\API\V1\RegisterController;
use App\Http\Controllers\API\V1\AgreementController;
use App\Http\Controllers\API\V1\MembershipCardController;

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
Route::get('membership-card', [MembershipCardController::class, 'index']);
Route::get('agreement/{agreement}', [AgreementController::class, 'show']);

Route::post('register/{type}', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

Route::post('check-otp', [OTPController::class, 'check_otp']);
Route::post('resend-otp', [OTPController::class, 'resend_otp']);

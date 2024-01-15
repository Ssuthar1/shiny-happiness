<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\PlanController;
use App\Http\Controllers\API\V1\BannerController;
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

/* Authentication Api */ 
Route::post('login/{type}', [UserController::class, 'userLogin']);
Route::post('register', [UserController::class, 'userRegister']);
Route::post('resend-otp/{type}', [UserController::class, 'resendOtp']);
Route::post('verify-otp/{type}', [UserController::class, 'verifyOtp']);
/* End Api */ 

///** Plan API Starts Here **///
	Route::get('plan-list', [PlanController::class, 'getPlanList']);
	Route::get('plan-detail', [PlanController::class, 'getPlanDetail']);
///** Plan API Ends Here **///

///** Banner API Starts Here **///
	Route::get('banner-list', [BannerController::class, 'getBannerList']);
	Route::get('banner-detail', [BannerController::class, 'getBannerDetail']);
///** Banner API Ends Here **///

Route::group(['prefix' => 'user'], function () {
	Route::group(['middleware' => ['auth:sanctum']], function () {
		Route::post('change-password', [UserController::class, 'changePassword']);
		Route::post('logout', [UserController::class, 'logout']);
		Route::get('profile', [UserController::class, 'getUserProfile']);
		Route::post('update-profile', [UserController::class, 'updateUserProfile']);
		Route::get('bank-detail', [UserController::class, 'getUserBankDetail']);
		Route::post('updatebank-detail', [UserController::class, 'updateUserBankDetail']);

		

	});
});
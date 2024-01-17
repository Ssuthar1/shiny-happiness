<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1', 'namespace' => 'v1'], function () {
        require(__DIR__ . '/API/v1/api.php');
    });
});
Route::any('/{any}', function () {
    return response()->json(['status' => "error", 'message' => "The API requested is not found", 'data' => []]);
})->where('any', '.*');
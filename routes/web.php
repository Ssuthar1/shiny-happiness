<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController; 
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [HomeController::class, 'index'])->name('home');  

/*Route::get('/payment-result/{response}', [HomeController::class, 'paymentResult'])->name('paymentResult');  */
Route::post('/payment-response', [HomeController::class, 'paymentResult'])->name('razorpayPaymentCallBack'); 
Route::get('/payment-status/{status}', [HomeController::class, 'paymentStatus'])->name('paymentStatus');

Route::get('/route-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('route:cache');
    return 'Routes cache cleared';
});
//Clear config cache:
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return 'Config cache cleared';
});
// Clear application cache:
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return 'Application cache cleared';
});
// Clear view cache:
Route::get('/view-clear', function () {
    Artisan::call('view:clear');
    return 'View cache cleared';
});
// Clear All:
Route::get('/clear-all', function () {
    // Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return 'All cache cleared';
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/
Route::get('/booking', [FileController::class, 'displayImage'])->name('displayImage'); 

Route::middleware('auth')->group(function () {

    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [DashboardController::class, 'users'])->name('dashboard.users');
    Route::get('/reports', [DashboardController::class, 'reports'])->name('dashboard.reports');
    Route::get('/roles-permissions', [DashboardController::class, 'rolesPermissions'])->name('dashboard.rolesPermissions'); 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*Booking Route Start*/
    Route::get('/booking-list', [DashboardController::class, 'bookingList'])->name('dashboard.bookingList');
    
    /*Booking Route End*/

    /*Payment Route Start*/
    Route::get('/payment-information', [DashboardController::class, 'paymentInformation'])->name('dashboard.paymentInformation');
    /*Payment Route End*/

});

require __DIR__.'/auth.php';

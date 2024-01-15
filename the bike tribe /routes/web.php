<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
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
// Clear view cache:
Route::get('/migrate-run', function () {
    try {
        Artisan::call('migrate');
    } catch (\Exception $e){
        $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
        $this->apiArray['errorCode'] = 2;
        $this->apiArray['error'] = true;
        $this->apiArray['data'] = null;
        return response()->json($this->apiArray, 200);
    }
    return 'Migrate run successfully.';
});
// Clear All:
Route::get('/clear-all', function () {
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return 'All cache cleared';
});
Route::get('/display-image', [FileController::class, 'displayImage'])->name('displayImage');

require __DIR__.'/front.php';

Route::group(['prefix' => 'bike-admin'], function () { 
    Route::middleware('auth')->group(function () { 
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');   
    Route::get('/users', [DashboardController::class, 'users'])->name('dashboard.users'); 
    Route::get('/roles-permissions', [DashboardController::class, 'rolesPermissions'])->name('dashboard.rolesPermissions'); 

    Route::get('/{module}', [DashboardController::class, 'adminModules'])->name('adminModule'); 

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /*Web Setting Route Start*/
    Route::get('/web-setting', [DashboardController::class, 'setting'])->name('dashboard.setting');
    /*Web Setting Route End*/ 

 });
});
 
require __DIR__.'/auth.php';

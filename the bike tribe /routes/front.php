<?php

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\DashboardController;
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

Route::get('/', [HomeController::class, 'index'])->name('homePage'); 
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('aboutUs');

Route::get('/tours', [HomeController::class, 'tours'])->name('tours');
Route::get('/book-tour', [HomeController::class, 'bookTour'])->name('bookTour');
Route::get('/booking-steps', [HomeController::class, 'bookingSteps'])->name('bookingSteps');

Route::get('/multi-day-tour', [HomeController::class, 'multiDayTour'])->name('multiDayTour');

Route::get('/tours/{tourid}', [HomeController::class, 'toursDetail'])->name('toursDetail');

Route::get('/destinations', [HomeController::class, 'destinations'])->name('destinations');

Route::get('/destinations/{destinationid}', [HomeController::class, 'destinationDetail'])->name('destinationDetail');

Route::get('/blog', [HomeController::class, 'blog'])->name('blog');

Route::get('/blog/{postid}', [HomeController::class, 'postDetail'])->name('postDetail');

Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contactUs');

Route::get('/return-policy', [HomeController::class, 'returnPolicy'])->name('returnPolicy');
Route::get('/terms-condition', [HomeController::class, 'termsCondition'])->name('termsCondition');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('confirm-subscription/{code}', [HomeController::class, 'confirmSubscription'])->name('confirmSubscription'); 
 






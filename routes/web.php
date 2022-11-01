<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LostAndFoundController;
use App\Http\Controllers\SlotRegistrationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('faqs', FaqController::class);
Route::resource('lost-and-found', LostAndFoundController::class);

//Route Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'showAdminLoginForm'])->name('login');
    Route::post('login/auth', [LoginController::class, 'adminLogin'])->name('login-auth');
    Route::get('dashboard', [DashboardController::class, 'showAdminDashboard'])->name('dashboard');
});

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

//Sponsors
Route::resource('sponsors', SponsorController::class);
Route::get('/sponsors/update-visibility/{sponsor}', [SponsorController::class, 'updateVisibility'])->name('sponsors.updateVisibility');

//slot registration
Route::resource('slot-registrations',SlotRegistrationController::class);
Route::get('/slot-registrations/confirm/{competitionSlot}', [SlotRegistrationController::class, 'confirm'])->name('slot-registrations.confirm');

Route::post('/slot-registrations/reject', [SlotRegistrationController::class, 'reject'])->name('slot-registrations.reject');


Route::get('/slot-registrations/cancel/{competitionSlot}', [SlotRegistrationController::class, 'cancel'])->name('slot-registrations.cancel');
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

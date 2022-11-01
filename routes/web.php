<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InstitutionContactController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MediaPartnerController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('faqs', FaqController::class);
Route::resource('lost-and-found', LostAndFoundController::class);

//Route Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'showAdminLoginForm'])->name('login');
    Route::post('login/auth', [LoginController::class, 'adminLogin'])->name('login-auth');
    Route::get('dashboard', [DashboardController::class, 'showAdminDashboard'])->name('dashboard');
});



//Sponsors
Route::resource('sponsors', SponsorController::class);
Route::get('/sponsors/update-visibility/{sponsor}', [SponsorController::class, 'updateVisibility'])->name('sponsors.updateVisibility');

//Media Partner
Route::resource('media-partners', MediaPartnerController::class)->except('show');
Route::get('media-partners/{media_partner}/update-visibility',[MediaPartnerController::class,'updateVisibility'])->name('media-partners.update-visibility');

//Inventory
Route::resource('inventories', InventoryController::class)->except('show');

// Insititution Contact
Route::resource('institution-contacts', InstitutionContactController::class)->except(['show', 'destroy']);


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaPartnerController;
use App\Models\MediaPartner;
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


//Route Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'showAdminLoginForm'])->name('login');
    Route::post('login/auth', [LoginController::class, 'adminLogin'])->name('login-auth');
    Route::get('dashboard', [DashboardController::class, 'showAdminDashboard'])->name('dashboard');
});

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

//Media Partner
Route::resource('media-partners', MediaPartnerController::class)->except('show');
Route::get('media-partners/{media_partner}/update-visibility',[MediaPartnerController::class,'updateVisibility'])->name('media-partners.update-visibility');
Route::get('/media-partners/manage', [MediaPartnerController::class, 'manage'])->name('media-partners.manage');
Route::get('/campaigns/manage', [CampaignController::class, 'manage'])->name('campaigns.manage');




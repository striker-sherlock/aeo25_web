<?php

use App\Http\Controllers\AccessControlController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\FollowUpTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstitutionContactController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LostAndFoundController;
use App\Http\Controllers\MediaPartnerController;
use App\Http\Controllers\SponsorController;
use App\Models\AccessControl;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('faqs', FaqController::class);
Route::resource('lost-and-found', LostAndFoundController::class);

//Route Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'showAdminLoginForm'])->name('login');
    Route::post('login/auth', [LoginController::class, 'adminLogin'])->name('login-auth');
    Route::get('dashboard', [DashboardController::class, 'showAdminDashboard'])->name('dashboard');
});



//Sponsors
// Route::resource('sponsors', SponsorController::class);
// Route::get('/sponsors/update-visibility/{sponsor}', [SponsorController::class, 'updateVisibility'])->name('sponsors.updateVisibility');

//Media Partner
Route::resource('media-partners', MediaPartnerController::class)->except('show');
Route::get('media-partners/{media_partner}/update-visibility',[MediaPartnerController::class,'updateVisibility'])->name('media-partners.update-visibility');

//Inventory
Route::resource('inventories', InventoryController::class)->except('show');

// Insititution Contact
Route::prefix('institution-contacts')->name('institution-contacts.')->group(function () {
    Route::get('/manage/{type}', [InstitutionContactController::class, 'index'])->name('index');
    Route::get('/{type}/create', [InstitutionContactController::class, 'create'])->name('create');
    Route::get('/{type}/{id}/edit', [InstitutionContactController::class, 'edit'])->name('edit');

});

Route::resource('institution-contacts', InstitutionContactController::class)->except(['show', 'destroy','index','create','edit']);

// Follow Up
Route::prefix('follow-ups')->name('follow-ups.')->group(function () {
    Route::get('/manage/{type}', [FollowUpController::class, 'index'])->name('index');
    Route::get('/{type}/{id}/edit', [FollowUpController::class, 'edit'])->name('edit');
    Route::put('assign-pic/{followUp}', [FollowUpController::class, 'assignPIC'])->name('assign-pic');
    Route::put('/update-status/{followUp}',[FollowUpController::class, 'updateStatus'])->name('update-status');
    Route::get('/{type}/create', [FollowUpController::class, 'create'])->name('create');
    Route::get('delete/{id}', [FollowUpController::class, 'delete'])->name('delete');
    Route::get('restore/{id}', [FollowUpController::class, 'restore'])->name('restore');
    
});
Route::resource('follow-ups', FollowUpController::class, ['except' => ['index','create']]);

Route::resource('follow-up-types', FollowUpTypeController::class); 

Route::resource('access-controls',AccessControlController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

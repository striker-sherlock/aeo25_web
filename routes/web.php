<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\FlightRegistrationController;
use App\Http\Controllers\FlightTicketController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InstitutionContactController;
use App\Http\Controllers\EnvironmentController;

use Illuminate\Support\Facades\Auth;

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

//Countries
Route::resource('countries', CountriesController::class);

//Countries
Route::resource('countries', CountriesController::class);

//Sponsors
Route::resource('sponsors', SponsorController::class);
Route::get('/sponsors/update-visibility/{sponsor}', [SponsorController::class, 'updateVisibility'])->name('sponsors.updateVisibility');

//Flight Registrations
Route::controller(FlightRegistrationController::class)->prefix('flight-registrations')->name('flight-registrations.')->group(function() {
    Route::post('{flightRegistrations}/store', 'store')->name('store');
});
Route::resource('flight-registrations', FlightRegistrationController::class);

//Flight Tickets
Route::controller(FlightTicketController::class)->prefix('flight-tickets')->name('flight-tickets.')->group(function() {
    Route::get('{flightTickets}/restore', 'restore')->name('restore');
    Route::delete('{flightTickets}/delete', 'delete')->name('delete');
});
Route::resource('flight-tickets', FlightTicketController::class, ['only'=>['index','edit', 'update', 'destroy']]);

//Facilities
Route::resource('facilities', FacilityController::class);

//Accommodation
Route::resource('accommodations', AccommodationController::class);

//Inventory
Route::resource('inventories', InventoryController::class)->except('show');

// Institution Contact
Route::resource('institution-contacts', InstitutionContactController::class)->except(['show', 'destroy']);

// Environments
Route::get('environments/{environment}/update-visibility',[EnvironmentController::class,'updateVisibility'])->name('environments.update-visibility');
Route::resource('environments', EnvironmentController::class);
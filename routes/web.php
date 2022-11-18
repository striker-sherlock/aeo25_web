<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\FlightTicketController;
use App\Http\Controllers\LostAndFoundController;
use App\Http\Controllers\MediaPartnerController;
use App\Http\Controllers\AccomodationsController;
use App\Http\Controllers\AccommodationSlotRegistrationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SlotRegistrationController;
use App\Http\Controllers\CompetitionPaymentController;
use App\Http\Controllers\FlightRegistrationController;
use App\Http\Controllers\InstitutionContactController;
use App\Http\Controllers\UserCompetitionPaymentController;
use App\Http\Controllers\AdminCompetitionPaymentController;
use App\Http\Controllers\UserCompetitionParticipantController;
// use Yajra\DataTables\DataTablesServiceProvider
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\EnvironmentController;


Auth::routes(['verify'=>true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('faqs', FaqController::class);
Route::resource('lost-and-found', LostAndFoundController::class);

//Route Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'showAdminLoginForm'])->name('login');
    Route::post('login/auth', [LoginController::class, 'adminLogin'])->name('login-auth');
    Route::get('dashboard', [DashboardController::class, 'showAdminDashboard'])->name('dashboard');
});

//register
Route::get('/register', [RegisterController::class, 'index'])->name('register');

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
Route::get('/dashboard/step-{step}', [DashboardController::class, 'step'])->name('dashboard.step');
//Countries
Route::resource('countries', CountriesController::class);

//Countries
Route::resource('countries', CountriesController::class);

//Sponsors
Route::resource('sponsors', SponsorController::class);
Route::get('/sponsors/update-visibility/{sponsor}', [SponsorController::class, 'updateVisibility'])->name('sponsors.updateVisibility');

//slot registration
Route::resource('slot-registrations',SlotRegistrationController::class);
Route::get('/slot-registrations/confirm/{competitionSlot}', [SlotRegistrationController::class, 'confirm'])->name('slot-registrations.confirm');

Route::post('/slot-registrations/reject', [SlotRegistrationController::class, 'reject'])->name('slot-registrations.reject');

Route::get('/slot-registrations/cancel/{competitionSlot}', [SlotRegistrationController::class, 'cancel'])->name('slot-registrations.cancel');


//Media Partner
Route::resource('media-partners', MediaPartnerController::class)->except('show');
Route::get('media-partners/{media_partner}/update-visibility',[MediaPartnerController::class,'updateVisibility'])->name('media-partners.update-visibility');

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

// INSTITUTION CONTACT
Route::resource('institution-contacts', InstitutionContactController::class)->except(['show', 'destroy']);


//COMPETITION PAYMENT ADMIN
Route::get('/{type}/payments', [AdminCompetitionPaymentController::class, 'index'])->name('competition-payments.index');
Route::get('/payments/confirm/{competitionSlot}', [AdminCompetitionPaymentController::class, 'confirm'])->name('competition-payments.confirm');

Route::post('/payments/reject', [AdminCompetitionPaymentController::class, 'reject'])->name('competition-payments.reject');

Route::get('/payments/cancel/{competitionSlot}', [AdminCompetitionPaymentController::class, 'cancel'])->name('competition-payments.cancel');

Route::get('/payments/export', [AdminCompetitionPaymentController::class, 'export'])->name('competition-payments.export');



//COMPETITION PAYMENT USER
Route::get('/payments/create/{id}', [UserCompetitionPaymentController::class, 'create'])->name('competition-payments.create');
Route::post('/payments/store', [UserCompetitionPaymentController::class, 'store'])->name('competition-payments.store');

Route::get('/payments/{competitionPayment}/edit', [UserCompetitionPaymentController::class, 'edit'])->name('competition-payments.edit');

Route::put('/payments/{competitionPayment}/update', [UserCompetitionPaymentController::class, 'update'])->name('competition-payments.update');

Route::delete('/payments/{competitionPayment}/destroy', [UserCompetitionPaymentController::class, 'destroy'])->name('competition-payments.destroy');

// USER COMPETITION PARTICIPANT
Route::get('/participants/{competition}', [UserCompetitionParticipantController::class, 'index'])->name('competition-participants.index');
Route::get('/participants/create/{competitionParticipant}', [UserCompetitionParticipantController::class, 'create'])->name('competition-participants.create');
Route::post('/participants/store', [UserCompetitionParticipantController::class, 'store'])->name('competition-participants.store');

// ADMIN COMPETITION PARTICIPANT


//Facilities
Route::resource('facilities', FacilityController::class);

//Accommodation
Route::resource('accommodations', AccommodationController::class);

//Accommodation Slot
Route::controller(AccommodationSlotRegistrationController::class)->prefix('accommodation-slot-registrations')->name('accommodation-slot-registrations.')->group(function(){
    Route::get('{accommodationSlot}/confirm', 'confirm')->name('confirm');
    Route::get('{accommodationSlot}/reject', 'reject')->name('reject');
    Route::get('{accommodationSlot}/cancel', 'cancel')->name('cancel');
});
Route::resource('accommodation-slot-registrations', AccommodationSlotRegistrationController::class, ['only'=>['index', 'create', 'destroy', 'store']]);

//Inventory
Route::resource('inventories', InventoryController::class)->except('show');

// Institution Contact
Route::resource('institution-contacts', InstitutionContactController::class)->except(['show', 'destroy']);

// Environments
Route::get('environments/{environment}/update-visibility',[EnvironmentController::class,'updateVisibility'])->name('environments.update-visibility');
Route::resource('environments', EnvironmentController::class);


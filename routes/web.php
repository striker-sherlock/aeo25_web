<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ScoreTypeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\RankingListController;
use App\Http\Controllers\FlightTicketController;
use App\Http\Controllers\LostAndFoundController;
use App\Http\Controllers\MediaPartnerController;
use App\Http\Controllers\UserAccommodationGuest;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\AccomodationsController;
use App\Http\Controllers\AdminAccommodationGuestController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SlotRegistrationController;
use App\Http\Controllers\CompetitionPaymentController;
use App\Http\Controllers\FlightRegistrationController;
// use Yajra\DataTables\DataTablesServiceProvider
use App\Http\Controllers\InstitutionContactController;
use App\Http\Controllers\UserCompetitionPaymentController;
use App\Http\Controllers\AdminCompetitionPaymentController;
use App\Http\Controllers\UserAccommodationPaymentController;
use App\Http\Controllers\AdminAccommodationPaymentController;
use App\Http\Controllers\UserCompetitionParticipantController;
use App\Http\Controllers\AdminCompetitionParticipantController;
use App\Http\Controllers\AccommodationSlotRegistrationController;

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
Route::get('/dashboard/accommodation-step-{step}', [DashboardController::class, 'accommodationStep'])->name('dashboard.accommodation-step');
//Countries
Route::resource('countries', CountriesController::class);

//Countries
Route::resource('countries', CountriesController::class);

//Sponsors
Route::resource('sponsors', SponsorController::class);
Route::get('/sponsors/update-visibility/{sponsor}', [SponsorController::class, 'updateVisibility'])->name('sponsors.updateVisibility');

//slot registration
Route::get('/slot-registrations/confirm/{competitionSlot}', [SlotRegistrationController::class, 'confirm'])->name('slot-registrations.confirm');
Route::post('/slot-registrations/reject', [SlotRegistrationController::class, 'reject'])->name('slot-registrations.reject');
Route::get('/slot-registrations/cancel/{competitionSlot}', [SlotRegistrationController::class, 'cancel'])->name('slot-registrations.cancel');
Route::resource('slot-registrations',SlotRegistrationController::class);


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
Route::get('/participants/show/{user}/{competitition}', [UserCompetitionParticipantController::class, 'show'])->name('competition-participants.show');
Route::post('/participants/store', [UserCompetitionParticipantController::class, 'store'])->name('competition-participants.store');

// ADMIN COMPETITION PARTICIPANT
Route::get('/edit-participant/{competitionParticipant}', [AdminCompetitionParticipantController::class, 'edit'])->name('competition-participants.edit');
Route::put('/participants/update/{id}', [AdminCompetitionParticipantController::class, 'update'])->name('competition-participants.update');
Route::get('/participants/export/{competitionParticipant}', [AdminCompetitionParticipantController::class, 'export'])->name('competition-participants.export');

//Facilities
Route::resource('facilities', FacilityController::class);

//Accommodation
Route::resource('accommodations', AccommodationController::class);

//Accommodation Slot
Route::controller(AccommodationSlotRegistrationController::class)->prefix('accommodation-slot-registrations')->name('accommodation-slot-registrations.')->group(function(){
    Route::get('{accommodationSlot}/confirm', 'confirm')->name('confirm');
    Route::get('{accommodationSlot}/reject', 'reject')->name('reject');
    Route::get('{accommodationSlot}/cancel', 'cancel')->name('cancel');
    Route::get('create/{accommodation?}', 'create')->name('create');

});
Route::resource('accommodation-slot-registrations', AccommodationSlotRegistrationController::class, ['only'=>['index', 'destroy', 'store', 'edit', 'update']]);

//USER ACCOMMODATION PAYMENT
Route::get('/accommodation-payments/create/{id}', [UserAccommodationPaymentController::class, 'create'])->name('accommodation-payments.create');
Route::post('/accommodation-payments/store', [UserAccommodationPaymentController::class, 'store'])->name('accommodation-payments.store');
Route::get('/accommodation-payments/{accommodationPayment}/edit', [UserAccommodationPaymentController::class, 'edit'])->name('accommodation-payments.edit');
Route::put('/accommodation-payments/{accommodationPayment}/update', [UserAccommodationPaymentController::class, 'update'])->name('accommodation-payments.update');
Route::delete('/accommodation-payments/{accommodationPayment}/destroy', [UserAccommodationPaymentController::class, 'destroy'])->name('accommodation-payments.destroy');

//ACCOMMODATION PAYMENT ADMIN
Route::get('/accommodation-payments', [AdminAccommodationPaymentController::class, 'index'])->name('accommodation-payments.index');
Route::get('/accommodation-payments/confirm/{accommodationPayment}', [AdminAccommodationPaymentController::class, 'confirm'])->name('accommodation-payments.confirm');
Route::post('/accommodation-payments/reject', [AdminAccommodationPaymentController::class, 'reject'])->name('accommodation-payments.reject');
Route::get('/accommodation-payments/cancel/{accommodationPayment}', [AdminAccommodationPaymentController::class, 'cancel'])->name('accommodation-payments.cancel');
Route::get('/accommodation-payments/export', [AdminAccommodationPaymentController::class, 'export'])->name('accommodation-payments.export');


//USER ACCOMMODATION GUEST
Route::get('/guests/create/{accommodationSlot}', [UserAccommodationGuest::class, 'create'])->name('accommodation-guests.create');
// Route::get('/participants/show/{user}/{competitition}', [UserCompetitionParticipantController::class, 'show'])->name('competition-participants.show');
Route::post('/guests/store', [UserAccommodationGuest::class, 'store'])->name('accommodation-guests.store');

// ADMIN ACCOMMODATION PARTICIPANT
Route::get('/guests/{roomType?}', [AdminAccommodationGuestController::class, 'index'])->name('accommodation-guests.index');
Route::get('/edit-guests/{accommodationGuest}', [AdminAccommodationGuestController::class, 'edit'])->name('accommodation-guests.edit');
Route::put('/guests/update/{id}', [AdminAccommodationGuestController::class, 'update'])->name('accommodation-guests.update');
// Route::get('/participants/export/{competitionParticipant}', [AdminCompetitionParticipantController::class, 'export'])->name('competition-participants.export');

//Inventory
Route::resource('inventories', InventoryController::class)->except('show');

// Institution Contact
Route::resource('institution-contacts', InstitutionContactController::class)->except(['show', 'destroy']);

// Environments
Route::get('environments/{environment}/update-visibility',[EnvironmentController::class,'updateVisibility'])->name('environments.update-visibility');
Route::resource('environments', EnvironmentController::class);

// Ranking List
Route::controller(RankingListController::class)->prefix('ranking-lists')->name('ranking-lists.')->group(function () {
    Route::get('manage/{competition}/{scoreType}', 'manage')->name('manage');
    Route::put('update-score/{competitionScore}', 'updateScore')->name('update-score');
    Route::get('update-score-type/{competitionScore}/{type}', 'updateScoreType')->name('update-score-type');
    Route::get('update-team-score-type/{competitionScore}/{competitionTeam}/{type}', 'updateTeamScoreType')->name('update-team-score-type');
    Route::get('update-debate-type/{competitionTeam}', 'updateDebateType')->name('update-debate-type');
});
Route::resource('ranking-lists', RankingListController::class)->only('index');

// Score Type
Route::resource('score-types', ScoreTypeController::class)->except('show');

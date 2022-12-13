<?php

use App\Models\AccessControl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ScoreTypeController;
use App\Http\Controllers\AmbassadorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\RankingListController;
use App\Http\Controllers\FlightTicketController;
use App\Http\Controllers\FollowUpTypeController;
use App\Http\Controllers\LostAndFoundController;
use App\Http\Controllers\MediaPartnerController;
use App\Http\Controllers\UserAccommodationGuest;
use App\Http\Controllers\AccessControlController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\AccomodationsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MerchandiseOrderController;
use App\Http\Controllers\SlotRegistrationController;
use App\Http\Controllers\FlightRegistrationController;
use App\Http\Controllers\InstitutionContactController;
use App\Http\Controllers\UserCompetitionPaymentController;
use App\Http\Controllers\AdminAccommodationGuestController;
use App\Http\Controllers\AdminCompetitionPaymentController;
use App\Http\Controllers\UserAccommodationPaymentController;
use App\Http\Controllers\AdminAccommodationPaymentController;
use App\Http\Controllers\UserCompetitionParticipantController;
use App\Http\Controllers\AdminCompetitionParticipantController;
use App\Http\Controllers\AccommodationSlotRegistrationController;

// Auth routes
Auth::routes(['verify'=>true]);

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Us
Route::get('/about-us', function() {
    return view('about-us');
}
);

// Masters
Route::resource('faqs', FaqController::class);
Route::resource('lost-and-found', LostAndFoundController::class);
Route::resource('countries', CountriesController::class);
Route::resource('follow-up-types', FollowUpTypeController::class); 
Route::resource('score-types', ScoreTypeController::class)->except('show');
Route::resource('accesses', AccessController::class);
Route::resource('access-controls',AccessControlController::class);
Route::post('access-controls/department',[AccessControlController::class,'accessDepartment'])->name('access-controls.access-department');
Route::post('access-controls/department-store',[AccessControlController::class,'departmentStore'])->name('access-controls.department-store');

Route::prefix('questions')->name('questions.')->group(function () {
    Route::get('viewreply/{question}', [QuestionController::class, 'viewreply'])->name('viewreply');
    Route::post('reply/{question}', [QuestionController::class, 'reply'])->name('reply');
    Route::get('confirm/{question}', [QuestionController::class, 'confirm'])->name('confirm');

});
Route::resource('questions', QuestionController::class)->except('show', 'create');



// PIC
Route::resource('users',PicController::class)->except('show');
Route::get('users/{id}/admin-edit',[PicController::class,'adminEdit'])->name('users.admin-edit');

// Admin
Route::resource('admins',AdminController::class)->except('show');

// Environments
Route::get('environments/{environment}/update-visibility',[EnvironmentController::class,'updateVisibility'])->name('environments.update-visibility');
Route::resource('environments', EnvironmentController::class);

// Ambassadors 
Route::get('ambassadors/manage', [AmbassadorController::class, 'manage'])->name('ambassadors.manage');
Route::resource('ambassadors', AmbassadorController::class)->except('show');

//merchandise
Route::resource('merchandises', MerchandiseController::class);

//merchandise order
Route::resource('merchandise-orders', MerchandiseOrderController::class)->except(['create','show','edit','update','store']);
Route::post('merchandise-orders/payment',[MerchandiseOrderController::class,'tempStore'])->name('merchandise-orders.temp-store');
Route::post('merchandise-orders/store',[MerchandiseOrderController::class,'store'])->name('merchandise-orders.store');



//competition 
Route::resource('competitions', CompetitionController::class);

// Sponsors
Route::resource('sponsors', SponsorController::class);
Route::get('/sponsors/update-visibility/{sponsor}', [SponsorController::class, 'updateVisibility'])->name('sponsors.updateVisibility');

//Media Partner
Route::resource('media-partners', MediaPartnerController::class)->except('show');
Route::get('media-partners/{media_partner}/update-visibility',[MediaPartnerController::class,'updateVisibility'])->name('media-partners.update-visibility');

// Institution Contact
Route::resource('institution-contacts', InstitutionContactController::class)->except(['show', 'destroy']);

//Inventory
Route::resource('inventories', InventoryController::class)->except('show');

//Route Admin
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login', [LoginController::class, 'showAdminLoginForm'])->name('login');
    Route::post('login/auth', [LoginController::class, 'adminLogin'])->name('login-auth');
    Route::get('dashboard', [DashboardController::class, 'showAdminDashboard'])->name('dashboard');
    Route::get('logout', [LoginController::class, 'adminLogout'])->name('logout');
    Route::get('loginAs', [LoginController::class, 'loginAsForm'])->name('login-as')->middleware('IsAdmin');
    Route::post('Auth/LoginAs', [LoginController::class, 'loginAs'])->name('auth-login-as')->middleware('IsAdmin');
});

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
Route::get('/dashboard/step-{step}', [DashboardController::class, 'step'])->name('dashboard.step');
Route::get('/dashboard/accommodation-step-{step}', [DashboardController::class, 'accommodationStep'])->name('dashboard.accommodation-step');

//Admin Privileges - Slot Registration
Route::controller(SlotRegistrationController::class)->prefix('slot-registrations')->name('slot-registrations.')->group(function () {
    Route::get('confirm/{competitionSlot}', 'confirm')->name('confirm');
    Route::get('pending/{competitionSlot}', 'pending')->name('pending');
    Route::post('reject', 'reject')->name('reject');
    Route::get('cancel/{competitionSlot}', 'cancel')->name('cancel');
    Route::get('create-others', 'createOthers')->name('create-other');
});
Route::resource('slot-registrations',SlotRegistrationController::class);

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

//Admin Privileges - Competition Payment
Route::get('/{type}/payments', [AdminCompetitionPaymentController::class, 'index'])->name('competition-payments.index');
Route::controller(AdminCompetitionPaymentController::class)->prefix('payments')->name('competition-payments.')->group(function () {
    Route::get('confirm/{competitionSlot}', 'confirm')->name('confirm');
    Route::get('pending/{competitionSlot}', 'pending')->name('pending');
    Route::post('reject', 'reject')->name('reject');
    Route::get('cancel/{competitionSlot}', 'cancel')->name('cancel');
    Route::get('export', 'export')->name('export');
});

//COMPETITION PAYMENT USER
Route::get('/paid-invoice/{payment}', [PDFController::class, 'paidInvoice'])->name('payments.paid-invoice');
Route::get('/competition-invoice/{user}/{id}', [PDFController::class, 'viewInvoice'])->name('payments.invoice');
Route::get('/payments/create/{id}', [UserCompetitionPaymentController::class, 'create'])->name('competition-payments.create');
Route::post('/payments/store', [UserCompetitionPaymentController::class, 'store'])->name('competition-payments.store');
Route::get('/payments/{competitionPayment}/edit', [UserCompetitionPaymentController::class, 'edit'])->name('competition-payments.edit');
Route::put('/payments/{competitionPayment}/update', [UserCompetitionPaymentController::class, 'update'])->name('competition-payments.update');
Route::delete('/payments/{competitionPayment}/destroy', [UserCompetitionPaymentController::class, 'destroy'])->name('competition-payments.destroy');

// User Privileges - Competition Participant
Route::controller(UserCompetitionParticipantController::class)->prefix('participants')->name('competition-participants.')->group(function () {
    Route::get('create/{competitionParticipant}', 'create')->name('create');
    Route::get('show/{user}/{competitition}', 'show')->name('show');
    Route::post('store', 'store')->name('store');
});

// Admin Privileges - Competition Participant
Route::get('/edit-participant/{competitionParticipant}', [AdminCompetitionParticipantController::class, 'edit'])->name('competition-participants.edit');
Route::controller(AdminCompetitionParticipantController::class)->prefix('participants')->name('competition-participants.')->group(function () {
    Route::get('{competition}', 'index')->name('index');
    Route::put('update/{id}', 'update')->name('update');
    Route::get('export/{competitionParticipant}', 'export')->name('export');
    Route::delete('destroy/{competitionParticipant}', 'destroy')->name('destroy');
    Route::delete('delete/{competitionParticipant}', 'delete')->name('delete');
    Route::get('restore/{competitionParticipant}', 'restore')->name('restore');

});

// Facilities
Route::resource('facilities', FacilityController::class);

// Accommodation
Route::resource('accommodations', AccommodationController::class);

// Accommodation Slot
Route::controller(AccommodationSlotRegistrationController::class)->prefix('accommodation-slot-registrations')->name('accommodation-slot-registrations.')->group(function(){
    Route::get('{accommodationSlot}/confirm', 'confirm')->name('confirm');
    Route::post('/reject', 'reject')->name('reject');
    Route::get('{accommodationSlot}/cancel', 'cancel')->name('cancel');
    Route::get('create/{accommodation?}', 'create')->name('create');
});
Route::resource('accommodation-slot-registrations', AccommodationSlotRegistrationController::class, ['only'=>['index', 'destroy', 'store', 'edit', 'update']]);

//USER ACCOMMODATION PAYMENT
    Route::get('/paid-accommodation-invoice/{payment}', [PDFController::class, 'paidAccommodationInvoice'])->name('payments.paid-accommodation-invoice');
    Route::get('/invoice/{user}/{id}', [PDFController::class, 'accommodationInvoice'])->name('accommodation-payments.invoice');
    Route::get('/accommodation-payments/create/{id}', [UserAccommodationPaymentController::class, 'create'])->name('accommodation-payments.create');
    Route::post('/accommodation-payments/store', [UserAccommodationPaymentController::class, 'store'])->name('accommodation-payments.store');
    Route::get('/accommodation-payments/{accommodationPayment}/edit', [UserAccommodationPaymentController::class, 'edit'])->name('accommodation-payments.edit');
    Route::put('/accommodation-payments/{accommodationPayment}/update', [UserAccommodationPaymentController::class, 'update'])->name('accommodation-payments.update');
    Route::delete('/accommodation-payments/{accommodationPayment}/destroy', [UserAccommodationPaymentController::class, 'destroy'])->name('accommodation-payments.destroy');

// Admin Privileges - Accommodation Payment
Route::controller(AdminAccommodationPaymentController::class)->prefix('accommodation-payments')->name('accommodation-payments.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/confirm/{accommodationPayment}', 'confirm')->name('confirm');
    Route::post('/reject', 'reject')->name('reject');
    Route::get('/cancel/{accommodationPayment}', 'cancel')->name('cancel');
    Route::get('/export', 'export')->name('export');
});

// User Privileges - Accommodation Guest
Route::controller(UserAccommodationGuest::class)->prefix('guests')->name('accommodation-guests.')->group(function () {
    Route::get('create/{accommodationSlot}', 'create')->name('create');
    Route::post('store', 'store')->name('store');
});

// Admin Privileges - Accommodation Guest
Route::get('/edit-guests/{accommodationGuest}', [AdminAccommodationGuestController::class, 'edit'])->name('accommodation-guests.edit');
Route::controller(AdminAccommodationGuestController::class)->prefix('guests')->name('accommodation-guests.')->group(function () {
    Route::get('{roomType?}', 'index')->name('index');
    Route::put('update/{id}', 'update')->name('update');
    Route::delete('destroy/{accommodationGuest}', 'destroy')->name('destroy');
    Route::delete('delete/{accommodationGuest}', 'delete')->name('delete');
    Route::get('restore/{accommodationGuest}', 'restore')->name('restore');
});

// Institution Contact
Route::controller()->prefix('')->name('.')->group(function () {

});
Route::controller(InstitutionContactController::class)->prefix('institution-contacts')->name('institution-contacts.')->group(function () {
    Route::get('/manage/{type}', 'index')->name('index');
    Route::get('/{type}/create', 'create')->name('create');
    Route::get('/{type}/{id}/edit', 'edit')->name('edit');
});
Route::resource('institution-contacts', InstitutionContactController::class)->except(['show', 'destroy','index','create','edit']);

// Follow Up
Route::controller(FollowUpController::class)->prefix('follow-ups')->name('follow-ups.')->group(function () {
    Route::get('/manage/{type}', 'index')->name('index');
    Route::get('/{type}/{id}/edit', 'edit')->name('edit');
    Route::put('assign-pic/{followUp}', 'assignPIC')->name('assign-pic');
    Route::put('/update-status/{followUp}','updateStatus')->name('update-status');
    Route::get('/{type}/create', 'create')->name('create');
    Route::get('delete/{id}', 'delete')->name('delete');
    Route::get('restore/{id}', 'restore')->name('restore');
}); 
Route::resource('follow-ups', FollowUpController::class, ['except' => ['index','create']]);

// Ranking List
Route::controller(RankingListController::class)->prefix('ranking-lists')->name('ranking-lists.')->group(function () {
    Route::get('manage/{competition}/{scoreType}', 'manage')->name('manage');
    Route::put('update-score/{competitionScore}', 'updateScore')->name('update-score');
    Route::get('update-score-type/{competitionScore}/{type}', 'updateScoreType')->name('update-score-type');
    Route::get('update-team-score-type/{competitionScore}/{competitionTeam}/{type}', 'updateTeamScoreType')->name('update-team-score-type');
    Route::get('update-debate-type/{competitionTeam}', 'updateDebateType')->name('update-debate-type');
});
Route::resource('ranking-lists', RankingListController::class)->only('index');

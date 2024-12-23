<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DonationController;

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

Route::get('/', [App\Http\Controllers\AdoptionController::class, 'index']);

Route::get('/showAdp', [App\Http\Controllers\AdoptionController::class, 'index'])->name('showAdp');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); //empty

//donation
Route::get('/donate', [App\Http\Controllers\DonationController::class, 'showDonationForm'])->name('donate.form');
Route::post('/donate/payment', [App\Http\Controllers\DonationController::class, 'paymentPost'])->name('donation.post');
Route::get('/donate/thank-you/{donation}', [App\Http\Controllers\DonationController::class, 'showThankYou'])->name('donation.thank-you');
Route::get('/donate/records', [App\Http\Controllers\DonationController::class, 'showDonationRecords'])->name('donations.records');
Route::get('/donation/receipt/{donation}', [DonationController::class, 'generateReceipt'])
    ->name('donation.receipt')
    ->middleware('auth');

//adminPage
Route::middleware(['auth', 'admin'])->group(function () {
    //pet verification
    Route::get('/admin/pets/verification', [PetController::class, 'showVerificationPage'])
        ->name('admin.pets.verification');
    Route::patch('/admin/pets/{pet}/verify', [PetController::class, 'verify'])
        ->name('pets.verify');
    Route::delete('/admin/pets/{pet}/reject', [PetController::class, 'reject'])
        ->name('pets.reject');
    //adoption verification
    Route::get('/admin/adoptions', [AdoptionController::class, 'adminIndex'])->name('admin.adoptions');
    Route::post('/admin/adoptions/{adoption}/status', [AdoptionController::class, 'updateStatus'])->name('admin.adoptions.status');

    //donation records
    Route::get('/admin/donations', [DonationController::class, 'showDonationRecordsAdmin'])->name('admin.donationRecords');
    Route::get('/admin/donations/{donation}', [DonationController::class, 'donationDetails'])->name('admin.donations.details');
    Route::get('/admin/donations/export', [DonationController::class, 'export'])->name('admin.donations.export');
    Route::get('/admin/donations/export/pdf', [DonationController::class, 'exportPdf'])->name('admin.donations.exportPdf');
    Route::get('/admin/donations/export/excel', [DonationController::class, 'exportExcel'])->name('admin.donations.exportExcel');
    Route::get('/admin/donations/export/csv', [DonationController::class, 'exportCsv'])->name('admin.donations.exportCsv');
    
});

Route::middleware(['auth'])->group(function () {
    //profile
    Route::get('/profile', [App\Http\Controllers\PageController::class, 'showProfile'])->name('showProfile'); //show all the user profile like username, address and so on.
    Route::get('/profileAvatar', [ProfileController::class, 'showAvatarEdit'])->name('updateAvatar'); //profile a platform to user to update their images
    Route::post('/profileAvadat/update', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar'); //post the image to the database
    Route::post('/profile/update-username', [ProfileController::class, 'updateUsername'])->name('profile.updateUsername');
    Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('user.updatePassword'); //new password
    Route::post('/profile/update-address', [ProfileController::class, 'updateAddress'])->name('profile.updateAddress');
    // add pet info
    Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
    Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
    Route::get('/pets/{pet}', [PetController::class, 'show'])->name('pets.show');  
    Route::get('/my-added', [PetController::class, 'myAdded'])->name('pets.myAdded');
    Route::get('/pets/{pet}/edit', [PetController::class, 'edit'])->name('pets.edit');
    Route::put('/pets/{pet}/update', [PetController::class, 'update'])->name('pets.update');
    //adoption system
    Route::post('/pets/{pet}/adopt', [AdoptionController::class, 'adopt'])->name('pets.adopt');
    Route::get('/adoptions', [AdoptionController::class, 'adoptionApplication'])->name('adoptions.application');
    
});






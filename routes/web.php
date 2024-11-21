<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

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

Route::get('/', function () {
    return view('common.showAdpPet');
});

Route::get('/show-adoptable-pet', [App\Http\Controllers\PageController::class, 'show'])->name('showAdp'); //index page

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); //empty

Route::get('/donate', [App\Http\Controllers\PageController::class, 'donate'])->name('donate'); //daonation page


//UserProfile
Route::get('/profile', [App\Http\Controllers\PageController::class, 'showProfile'])->name('showProfile'); //show all the user profile like username, address and so on.
Route::get('/profileAvatar', [App\Http\Controllers\ProfileController::class, 'showAvatarEdit'])->name('updateAvatar'); //profile a platform to user to update their images
Route::post('/profileAvadat/update', [App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar'); //post the image to the database
Route::post('/profile/update-username', [App\Http\Controllers\ProfileController::class, 'updateUsername'])->name('profile.updateUsername');
Route::post('/update-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('user.updatePassword'); //new password

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/pets/verify', [PetController::class, 'index'])->name('pets.index');
    Route::patch('/admin/pets/{pet}/verify', [PetController::class, 'verify'])->name('pets.verify');
    Route::delete('/admin/pets/{pet}/reject', [PetController::class, 'reject'])->name('pets.reject');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
    Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
});


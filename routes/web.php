<?php

use App\Http\Controllers\AddEventController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\EventPageController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Artisan
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

// Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home'); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('profile', [ProfileController::class, 'index'])->name('profile');

Route::get('add-event', [AddEventController::class, 'index'])->name('add_event');
Route::get('event/{id}', [EventPageController::class, 'index'])->name('event_page.{id}');
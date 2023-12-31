<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CastController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\PeranController;
use App\Http\Controllers\ProfileController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function() {
    // register form
    Route::get('/register', 'register')->name('auth.register');
    // store register
    Route::post('/store', 'store')->name('auth.store');
    // login form
    Route::get('/login', 'login')->name('auth.login');
    // auth proses
    Route::post('/auth', 'auth')->name('auth.authentication');
    // logout
    Route::post('/logout', 'logout')->name('auth.logout');
    // dashboard page
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'index']);

Route::get('/about', function () {
    return view('layouts.master');
})->name('get-about');

Route::get('/form', [UserController::class, 'form']);


Route::resource('/genre', GenreController::class)->middleware('auth');

// For CRUD table cast
Route::resource('/cast', CastController::class)->middleware('auth');
// FOR CRUD Table Film
Route::resource('/film', FilmController::class)->middleware('auth');

Route::get('/film/{film}/peran/create', [PeranController::class, 'create'])->name('peran.create')->middleware('auth');
Route::post('/film/{film}/peran', [PeranController::class, 'store'])->name('peran.store')->middleware('auth');

Route::get('/profile/{user}/show', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');

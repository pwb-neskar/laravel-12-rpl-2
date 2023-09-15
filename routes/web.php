<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CastController;
use App\Http\Controllers\GenreController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'index']);

Route::get('/about', function () {
    return view('layouts.master');
})->name('get-about');

Route::get('/form', [UserController::class, 'form']);

Route::get('/dashboard', function () {
    return view('home');
})->name('get-user-dashboard-page');

Route::resource('/genre', GenreController::class);

// For CRUD table cast
Route::resource('/cast', CastController::class);
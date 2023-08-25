<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route::get('/about', function () {
//     return view('about');
// })->name('get-about');

Route::get('/form', [UserController::class, 'form']);

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('get-user-dashboard-page');
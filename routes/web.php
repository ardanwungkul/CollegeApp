<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YoutubeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('checkRole:admin')->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('group', GroupUserController::class);
    Route::get('/youtube', [YoutubeController::class, 'index'])->name('youtube.index');
    Route::post('/youtube', [YoutubeController::class, 'store'])->name('youtube.store');
    Route::get('/youtube/create', [YoutubeController::class, 'create'])->name('youtube.create');
    Route::get('/youtube/{youtube}/edit', [YoutubeController::class, 'edit'])->name('youtube.edit');
    Route::put('/youtube/{youtube}', [YoutubeController::class, 'update'])->name('youtube.update');
    Route::delete('/youtube/{youtube}', [YoutubeController::class, 'destroy'])->name('youtube.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/youtube/{youtube}', [YoutubeController::class, 'show'])->name('youtube.show');
});
Route::middleware('checkRole:user')->group(function () {});

require __DIR__ . '/auth.php';

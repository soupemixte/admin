<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BottleController;
use App\Http\Controllers\CellarBottleController;
use App\Http\Controllers\CellarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SetLocaleController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\CellierBottleController;

// User Routes
Route::get('/registration', [UserController::class, 'create'])->name('user.create');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');
// Auth Routes
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Authentication Routes
Route::get('/', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::get('/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

//Authentification de l'administrateur avec fonctionnalités autorisées pour l'administrateur
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::middleware('auth:admin')->group(function () {
    });
});

Route::get('/scrape-bouteilles', [BottleController::class, 'scrape'])->name('bottle.scrape');
Route::get('/scraping/stop', [BottleController::class, 'stopScraping'])->name('scraping.stop');
/**
 * Comptage des bouteilles en temps réel
 */
Route::get('/api/total-bottles', [BottleController::class, 'getTotalBottles'])->name('bottle.total_bottles');




Route::get('/lang/{locale}', [SetLocaleController::class, 'index'])->name('lang');
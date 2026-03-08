<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectPaymentController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/history', [HomeController::class, 'history'])->name('history');
Route::get('/location', [HomeController::class, 'location'])->name('location');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Progress resource routes
    Route::resource('progress', ProgressController::class);

    // Project management routes
    Route::resource('dashboard/projects', ProjectController::class, [
        'names' => 'dashboard.projects'
    ]);
    Route::get('dashboard/projects/{project}/deal-proof', [ProjectController::class, 'showDealProof'])
        ->name('dashboard.projects.deal-proof');
    Route::post('dashboard/projects/{project}/payments', [ProjectPaymentController::class, 'store'])
        ->name('dashboard.projects.payments.store');
    Route::get('dashboard/projects/{project}/payments/{payment}/proof', [ProjectPaymentController::class, 'showProof'])
        ->name('dashboard.projects.payments.proof');
    Route::delete('dashboard/projects/{project}/payments/{payment}', [ProjectPaymentController::class, 'destroy'])
        ->name('dashboard.projects.payments.destroy');
    
    // Portfolio resource routes
    Route::resource('dashboard/portfolios', PortfolioController::class, [
        'names' => 'dashboard.portfolios'
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\IncomeStatementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route for the home page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route for the dashboard page with middleware for authentication and email verification
Route::get('/dashboard', [IncomeStatementController::class, 'showCompanies'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Routes that require authentication
Route::middleware('auth')->group(function () {
    // Profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes for importing data
    Route::view('import', 'income.import')->name('importfile');
    Route::post('/import', [IncomeStatementController::class, 'import'])->name('import.excel');
    
    // Route for displaying companies
    Route::get('company', [IncomeStatementController::class, 'showCompanies'])->name('company');
    
    // Route for displaying charts
    Route::get('chart/{id}', [IncomeStatementController::class, 'chart'])->name('chart');

    // Route for logging out (not typical for a controller method; usually handled by Laravel’s default logout route)
    Route::get('logout', [IncomeStatementController::class, 'logout'])->name('logout');
    
    // Additional routes for data management
    Route::get('erase', [IncomeStatementController::class, 'erase'])->name('erase');
});

require __DIR__.'/auth.php';

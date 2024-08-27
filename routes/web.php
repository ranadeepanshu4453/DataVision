<?php

use App\Http\Controllers\IncomeStatementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/dashboard', [IncomeStatementController::class, 'showCompanies'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    // Profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('import', 'income.import')->name('importfile');
    Route::post('/import', [IncomeStatementController::class, 'import'])->name('import.excel');    
    Route::get('company', [IncomeStatementController::class, 'showCompanies'])->name('company');
    Route::get('chart/{id}', [IncomeStatementController::class, 'chart'])->name('chart');
    Route::get('logout', [IncomeStatementController::class, 'logout'])->name('logout');
    Route::get('erase', [IncomeStatementController::class, 'erase'])->name('erase');

    //Delete particular company
    Route::get('/delete-company/{id}', [IncomeStatementController::class, 'deleteCompany'])->name('delete.company');
    //updated Companies
    Route::get('update-company/{id}', [IncomeStatementController::class, 'updatedCompany'])->name('update.company');

});

require __DIR__.'/auth.php';

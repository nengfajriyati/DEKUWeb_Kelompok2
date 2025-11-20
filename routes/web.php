<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// INCOME PAGE
Route::middleware('auth')->group(function () {

    Route::get('/income', [IncomeController::class, 'index'])->name('income.index');
    Route::get('/income/create', [IncomeController::class, 'create'])->name('income.create');
    Route::post('/income', [IncomeController::class, 'store'])->name('income.store');

    Route::get('/income/{id}/edit', [IncomeController::class, 'edit'])->name('income.edit');
    Route::put('/income/{id}', [IncomeController::class, 'update'])->name('income.update');

    Route::delete('/income/{id}', [IncomeController::class, 'destroy'])->name('income.destroy');
});

require __DIR__.'/auth.php';

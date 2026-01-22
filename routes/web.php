<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ExpenseController;

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



// EXPENSE PAGE
Route::middleware('auth')->group(function () {

    Route::get('/expense', [ExpenseController::class, 'index'])->name('expense.index');
    Route::get('/expense/create', [ExpenseController::class, 'create'])->name('expense.create');
    Route::post('/expense', [ExpenseController::class, 'store'])->name('expense.store');

    Route::get('/expense/{id}/edit', [ExpenseController::class, 'edit'])->name('expense.edit');
    Route::put('/expense/{id}', [ExpenseController::class, 'update'])->name('expense.update');

    Route::delete('/expense/{id}', [ExpenseController::class, 'destroy'])->name('expense.destroy');

});

Route::resource('wallet', WalletController::class);

Route::middleware('auth')->group(function () {

    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::get('/wallet/create', [WalletController::class, 'create'])->name('wallet.create');
    Route::post('/wallet', [WalletController::class, 'store'])->name('wallet.store');

});



Route::resource('goal', GoalController::class)->middleware('auth');


require __DIR__.'/auth.php';

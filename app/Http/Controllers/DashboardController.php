<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;
use App\Models\Wallet;

class DashboardController extends Controller
{
    public function index()
    {
        // sementara untuk tugas → pakai user dummy ID 1
        $userId = 1;

        $totalIncome   = Income::where('user_id', $userId)->sum('amount');
        $totalExpense  = Expense::where('user_id', $userId)->sum('amount');
        $walletBalance = Wallet::where('user_id', $userId)->sum('balance');

        return view('dashboard.index', compact(
            'totalIncome',
            'totalExpense',
            'walletBalance'
        ));
    }
}

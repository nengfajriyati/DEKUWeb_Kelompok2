<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::where('user_id', auth()->id())
            ->with('wallet')
            ->latest()
            ->get();

        return view('expense.index', compact('expenses'));
    }

    public function create()
    {
        $wallets = Wallet::where('user_id', auth()->id())->get();
        return view('expense.create', compact('wallets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string',
        ]);

        DB::transaction(function () use ($request) {

            $wallet = Wallet::findOrFail($request->wallet_id);

            // CEK SALDO
            if ($request->amount > $wallet->balance) {
                abort(400, 'Saldo dompet tidak mencukupi');
            }

            Expense::create([
                'user_id' => auth()->id(),
                'wallet_id' => $wallet->id,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);

            // KURANGI SALDO
            $wallet->decrement('balance', $request->amount);
        });

        return redirect()->route('expense.index')
            ->with('success', 'Pengeluaran berhasil dicatat & saldo diperbarui');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            $expense = Expense::findOrFail($id);
            $wallet = Wallet::findOrFail($expense->wallet_id);

            // KEMBALIKAN SALDO
            $wallet->increment('balance', $expense->amount);

            $expense->delete();
        });

        return redirect()->route('expense.index')
            ->with('success', 'Pengeluaran dihapus & saldo dikembalikan');
    }
}

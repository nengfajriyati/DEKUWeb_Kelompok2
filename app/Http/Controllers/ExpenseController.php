<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Wallet;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('wallet')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
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
            'amount' => ['required', 'regex:/^[0-9]+$/'],
            'description' => 'nullable|string'
        ]);

        // ❌ larang tanda +
        if (str_contains($request->amount, '+')) {
            return back()->withInput()
                ->with('error', 'Nominal tidak boleh mengandung tanda +');
        }

        $wallet = Wallet::findOrFail($request->wallet_id);

        if ($request->amount > $wallet->balance) {
            return back()->with('error', 'Saldo dompet tidak mencukupi');
        }

        Expense::create([
            'user_id' => auth()->id(),
            'wallet_id' => $wallet->id,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        $wallet->decrement('balance', $request->amount);

        return redirect()->route('expense.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $expense = Expense::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $wallets = Wallet::where('user_id', auth()->id())->get();

        return view('expense.edit', compact('expense', 'wallets'));
    }

    public function update(Request $request, $id)
    {
        $expense = Expense::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => ['required', 'regex:/^[0-9]+$/'],
            'description' => 'nullable|string'
        ]);

        // ❌ larang tanda +
        if (str_contains($request->amount, '+')) {
            return back()->withInput()
                ->with('error', 'Nominal tidak boleh mengandung tanda +');
        }

        $oldWallet = Wallet::findOrFail($expense->wallet_id);
        $newWallet = Wallet::findOrFail($request->wallet_id);

        // balikin saldo lama
        $oldWallet->increment('balance', $expense->amount);

        if ($request->amount > $newWallet->balance) {
            // rollback saldo lama
            $oldWallet->decrement('balance', $expense->amount);
            return back()->with('error', 'Saldo dompet tidak mencukupi');
        }

        $expense->update([
            'wallet_id' => $request->wallet_id,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        $newWallet->decrement('balance', $request->amount);

        return redirect()->route('expense.index')
            ->with('success', 'Pengeluaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $expense = Expense::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $wallet = Wallet::findOrFail($expense->wallet_id);

        $wallet->increment('balance', $expense->amount);
        $expense->delete();

        return redirect()->route('expense.index')
            ->with('success', 'Pengeluaran berhasil dihapus');
    }
}

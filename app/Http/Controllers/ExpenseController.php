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
            'wallet_id'   => 'required|exists:wallets,id',
            'amount'      => 'required|numeric|min:1',
            'date'        => 'required|date',
            'description' => 'nullable|string',
        ]);

        $wallet = Wallet::where('id', $request->wallet_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($request->amount > $wallet->balance) {
            return back()->with('error', 'Saldo dompet tidak mencukupi');
        }

        Expense::create([
            'user_id'     => auth()->id(),
            'wallet_id'   => $wallet->id,
            'amount'      => $request->amount,
            'description' => $request->description,
            'created_at'  => $request->date, // ⬅️ PENTING
        ]);

        $wallet->decrement('balance', $request->amount);

        return redirect()->route('expense.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $expense = Expense::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $wallets = Wallet::where('user_id', auth()->id())->get();

        return view('expense.edit', compact('expense', 'wallets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'wallet_id'   => 'required|exists:wallets,id',
            'amount'      => 'required|numeric|min:1',
            'date'        => 'required|date',
            'description' => 'nullable|string',
        ]);

        $expense = Expense::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $oldWallet = Wallet::findOrFail($expense->wallet_id);
        $newWallet = Wallet::findOrFail($request->wallet_id);

        $oldWallet->increment('balance', $expense->amount);

        if ($request->amount > $newWallet->balance) {
            $oldWallet->decrement('balance', $expense->amount);
            return back()->with('error', 'Saldo dompet tidak mencukupi');
        }

        $expense->update([
            'wallet_id'   => $newWallet->id,
            'amount'      => $request->amount,
            'description' => $request->description,
            'created_at'  => $request->date, // ⬅️ UPDATE TANGGAL
        ]);

        $newWallet->decrement('balance', $request->amount);

        return redirect()->route('expense.index')
            ->with('success', 'Pengeluaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $expense = Expense::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $expense->wallet->increment('balance', $expense->amount);
        $expense->delete();

        return redirect()->route('expense.index')
            ->with('success', 'Pengeluaran berhasil dihapus');
    }
}

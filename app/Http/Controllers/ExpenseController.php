<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Wallet;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    // =============================
    // LIST DATA (INDEX)
    // =============================
    public function index()
    {
        $expenses = Expense::where('user_id', auth()->id())
            ->with('wallet') // relasi wallet
            ->orderBy('created_at', 'desc')
            ->get();

        return view('expense.index', compact('expenses'));
    }

    // =============================
    // FORM TAMBAH
    // =============================
    public function create()
    {
        $wallets = Wallet::where('user_id', auth()->id())->get();

        return view('expense.create', compact('wallets'));
    }

    // =============================
    // SIMPAN DATA baru (STORE)
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        Expense::create([
            'user_id' => auth()->id(),
            'wallet_id' => $request->wallet_id,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->route('expense.index')->with('success', 'Pengeluaran berhasil ditambahkan!');
    }

    // =============================
    // FORM EDIT
    // =============================
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        $wallets = Wallet::where('user_id', auth()->id())->get();

        return view('expense.edit', compact('expense', 'wallets'));
    }

    // =============================
    // UPDATE DATA
    // =============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        $expense = Expense::findOrFail($id);

        $expense->update([
            'wallet_id' => $request->wallet_id,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->route('expense.index')->with('success', 'Data pengeluaran berhasil diperbarui!');
    }

    // =============================
    // DELETE DATA
    // =============================
    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('expense.index')->with('success', 'Pengeluaran berhasil dihapus.');
    }
}

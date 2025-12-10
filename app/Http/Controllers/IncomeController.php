<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Wallet;
use App\Models\Category;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    // =============================
    // LIST DATA
    // =============================
    public function index()
    {
        $incomes = Income::where('user_id', auth()->id())
            ->with('wallet') // Eager load relasi wallet
            ->orderBy('created_at', 'desc')
            ->get();

        return view('income.index', compact('incomes'));
    }

    // =============================
    // FORM TAMBAH
    // =============================
    public function create()
    {
        $wallets = Wallet::where('user_id', auth()->id())->get();

        return view('income.create', compact('wallets'));
    }

    // =============================
    // SIMPAN DATA
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        Income::create([
            'user_id' => auth()->id(),
            'wallet_id' => $request->wallet_id,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->route('income.index')->with('success', 'Pemasukan berhasil ditambahkan!');
    }

    // =============================
    // FORM EDIT
    // =============================
    public function edit($id)
    {
        $income = Income::findOrFail($id);
        $wallets = Wallet::where('user_id', auth()->id())->get();

        return view('income.edit', compact('income', 'wallets'));
    }

    // =============================
    // UPDATE
    // =============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        $income = Income::findOrFail($id);

        $income->update([
            'wallet_id' => $request->wallet_id,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->route('income.index')->with('success', 'Data pemasukan diperbarui!');
    }

    // =============================
    // DELETE
    // =============================
    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();

        return redirect()->route('income.index')->with('success', 'Pemasukan berhasil dihapus.');
    }
}

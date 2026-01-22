<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Wallet;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::where('user_id', auth()->id())
            ->with('wallet')
            ->latest() // pakai created_at
            ->get();

        return view('income.index', compact('incomes'));
    }

    public function create()
    {
        $wallets = Wallet::where('user_id', auth()->id())->get();
        return view('income.create', compact('wallets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|min:1',
            'description' => 'required',
        ]);

        $income = Income::create([
            'user_id' => auth()->id(),
            'wallet_id' => $request->wallet_id,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        // UPDATE SALDO DOMPET
        $income->wallet->increment('balance', $request->amount);

        return redirect()->route('income.index')
            ->with('success', 'Pemasukan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $income = Income::findOrFail($id);
        $wallets = Wallet::where('user_id', auth()->id())->get();

        return view('income.edit', compact('income', 'wallets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|min:1',
            'description' => 'required',
        ]);

        $income = Income::findOrFail($id);

        // BALIKIN SALDO LAMA
        $income->wallet->decrement('balance', $income->amount);

        // UPDATE DATA
        $income->update($request->all());

        // TAMBAH SALDO BARU
        $income->wallet->increment('balance', $request->amount);

        return redirect()->route('income.index')
            ->with('success', 'Pemasukan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $income = Income::findOrFail($id);

        // KURANGI SALDO DOMPET
        $income->wallet->decrement('balance', $income->amount);

        $income->delete();

        return redirect()->route('income.index')
            ->with('success', 'Pemasukan berhasil dihapus');
    }
}

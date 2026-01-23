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
            ->orderBy('date', 'desc')
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
            'wallet_id' => 'required',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string',
        ]);

        Income::create([
            'user_id' => auth()->id(),
            'wallet_id' => $request->wallet_id,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->route('income.index')
            ->with('success', 'Pemasukan berhasil ditambahkan');
    }


    public function edit($id)
    {
        $income = Income::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $wallets = Wallet::where('user_id', auth()->id())->get();

        return view('income.edit', compact('income', 'wallets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'wallet_id'   => 'required|exists:wallets,id',
            'amount'      => 'required|numeric|min:1',
            'date'        => 'required|date',
            'description' => 'nullable|string',
        ]);

        $income = Income::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $oldWallet = Wallet::findOrFail($income->wallet_id);
        $newWallet = Wallet::findOrFail($request->wallet_id);

        $oldWallet->decrement('balance', $income->amount);

        $income->update([
            'wallet_id'   => $newWallet->id,
            'amount'      => $request->amount,
            'date'        => $request->date,
            'description' => $request->description,
        ]);

        $newWallet->increment('balance', $request->amount);

        return redirect()->route('income.index')
            ->with('success', 'Pemasukan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $income = Income::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $wallet = Wallet::findOrFail($income->wallet_id);
        $wallet->decrement('balance', $income->amount);

        $income->delete();

        return redirect()->route('income.index')
            ->with('success', 'Pemasukan berhasil dihapus');
    }
}

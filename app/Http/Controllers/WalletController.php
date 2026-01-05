<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        $wallets = Wallet::where('user_id', auth()->id())->get();
        return view('wallet.index', compact('wallets'));
    }

    public function create()
    {
        return view('wallet.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'balance' => 'required|numeric',
        ]);

        Wallet::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'balance' => $request->balance,
        ]);

        return redirect()->route('wallet.index')
            ->with('success', 'Dompet berhasil ditambahkan');
    }

    public function edit($id)
    {
        $wallet = Wallet::findOrFail($id);
        return view('wallet.edit', compact('wallet'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $wallet = Wallet::findOrFail($id);
        $wallet->update([
            'name' => $request->name,
        ]);

        return redirect()->route('wallet.index')
                        ->with('success', 'Dompet berhasil diperbarui');
    }

    public function destroy($id)
    {
        $wallet = Wallet::findOrFail($id);

        // optional safety (kalau ada relasi income / expense)
        if ($wallet->incomes()->count() > 0 || $wallet->expenses()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Dompet tidak bisa dihapus karena masih memiliki transaksi');
        }

        $wallet->delete();

        return redirect()->route('wallet.index')
                        ->with('success', 'Dompet berhasil dihapus');
    }
}

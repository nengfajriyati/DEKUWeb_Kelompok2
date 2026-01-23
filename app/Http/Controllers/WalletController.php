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
            'name'    => 'required|string|max:100',
            'balance' => 'required|numeric|min:0',
        ]);

        Wallet::create([
            'user_id' => auth()->id(),
            'name'    => $request->name,
            'balance' => $request->balance,
        ]);

        return redirect()->route('wallet.index')
            ->with('success', 'Dompet berhasil ditambahkan');
    }

    public function edit($id)
    {
        $wallet = Wallet::where('user_id', auth()->id())
                        ->where('id', $id)
                        ->firstOrFail();

        return view('wallet.edit', compact('wallet'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $wallet = Wallet::where('user_id', auth()->id())
                        ->where('id', $id)
                        ->firstOrFail();

        $wallet->update([
            'name' => $request->name,
        ]);

        return redirect()->route('wallet.index')
            ->with('success', 'Dompet berhasil diperbarui');
    }

    public function destroy($id)
    {
        $wallet = Wallet::where('user_id', auth()->id())
                        ->where('id', $id)
                        ->firstOrFail();

        if ($wallet->incomes()->count() > 0 || $wallet->expenses()->count() > 0) {
            return back()->with('error', 'Dompet tidak bisa dihapus karena masih memiliki transaksi');
        }

        $wallet->delete();

        return redirect()->route('wallet.index')
            ->with('success', 'Dompet berhasil dihapus');
    }
}

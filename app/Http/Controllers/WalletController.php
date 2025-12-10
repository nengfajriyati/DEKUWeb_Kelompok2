<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallets = Wallet::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('wallet.index', compact('wallets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wallet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric|min:0',
        ]);

        Wallet::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'balance' => $request->balance,
            // 'icon' => $request->icon, // Jika kamu menambahkan field icon
        ]);

        return redirect()->route('wallet.index')->with('success', 'Dompet berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * (Tidak digunakan untuk CRUD dasar, bisa dikosongkan)
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wallet $wallet)
    {
        // Memastikan pengguna hanya bisa mengedit dompet miliknya
        if ($wallet->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('wallet.edit', compact('wallet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wallet $wallet)
    {
        if ($wallet->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric|min:0',
        ]);

        $wallet->update($request->only(['name', 'balance']));

        return redirect()->route('wallet.index')->with('success', 'Data dompet berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wallet $wallet)
    {
        if ($wallet->user_id === Auth::id()) {
            $wallet->delete();
            return redirect()->route('wallet.index')->with('success', 'Dompet berhasil dihapus.');
        }
        return redirect()->route('wallet.index')->with('error', 'Gagal menghapus dompet.');
    }
}
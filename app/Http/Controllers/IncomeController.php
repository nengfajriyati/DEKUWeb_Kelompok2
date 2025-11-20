<?php

namespace App\Http\Controllers;

use App\Models\Income;
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
            ->orderBy('created_at', 'desc')
            ->get();

        return view('income.index', compact('incomes'));
    }

    // =============================
    // FORM TAMBAH
    // =============================
    public function create()
    {
        return view('income.create');
    }

    // =============================
    // SIMPAN DATA
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        Income::create([
            'user_id' => auth()->id(),
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

        return view('income.edit', compact('income'));
    }

    // =============================
    // UPDATE
    // =============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        $income = Income::findOrFail($id);

        $income->update([
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

<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::where('user_id', auth()->id())
            ->orderBy('deadline', 'asc')
            ->get();

        return view('goal.index', compact('goals'));
    }

    public function create()
    {
        return view('goal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'target_amount' => 'required|numeric|min:1',
            'deadline' => 'nullable|date',
        ]);

        Goal::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'target_amount' => $request->target_amount,
            'current_amount' => 0,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('goal.index')
            ->with('success', 'Goals berhasil ditambahkan');
    }

    public function edit($id)
    {
        $goal = Goal::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return view('goal.edit', compact('goal'));
    }

    public function update(Request $request, $id)
    {
        $goal = Goal::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:100',
            'target_amount' => 'required|numeric|min:1',
            'deadline' => 'nullable|date',
        ]);

        $goal->update([
            'title' => $request->title,
            'target_amount' => $request->target_amount,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('goal.index')
            ->with('success', 'Goals berhasil diperbarui');
    }

    public function destroy($id)
    {
        $goal = Goal::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $goal->delete();

        return redirect()->route('goal.index')
            ->with('success', 'Goals berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('goal.index', compact('goals'));
    }

    public function create()
    {
        return view('goal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'target_amount' => 'required|numeric|min:1',
            'deadline' => 'nullable|date'
        ]);

        Goal::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'target_amount' => $request->target_amount,
            'deadline' => $request->deadline
        ]);

        return redirect()->route('goal.index')
            ->with('success', 'Goal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $goal = Goal::where('user_id', auth()->id())->findOrFail($id);
        return view('goal.edit', compact('goal'));
    }

    public function update(Request $request, $id)
    {
        $goal = Goal::where('user_id', auth()->id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'target_amount' => 'required|numeric|min:1',
            'deadline' => 'nullable|date'
        ]);

        $goal->update([
            'title' => $request->title,
            'target_amount' => $request->target_amount,
            'deadline' => $request->deadline
        ]);

        return redirect()->route('goal.index')
            ->with('success', 'Goal berhasil diperbarui');
    }

    public function destroy($id)
    {
        $goal = Goal::where('user_id', auth()->id())->findOrFail($id);
        $goal->delete();

        return redirect()->route('goal.index')
            ->with('success', 'Goal berhasil dihapus');
    }
}

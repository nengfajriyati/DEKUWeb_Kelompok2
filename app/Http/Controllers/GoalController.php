<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::where('user_id', auth()->id())->get();
        return view('goal.index', compact('goals'));
    }

    public function create()
    {
        return view('goal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'target_amount' => 'required|numeric|min:1',
            'deadline' => 'nullable|date',
        ]);

        Goal::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'target_amount' => $request->target_amount,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('goal.index')->with('success', 'Goals berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $goal = Goal::findOrFail($id);
        return view('goal.edit', compact('goal'));
    }

    public function update(Request $request, $id)
    {
        $goal = Goal::findOrFail($id);

        $goal->update($request->only([
            'title','target_amount','current_amount','deadline'
        ]));

        return redirect()->route('goal.index')->with('success', 'Goals diperbarui!');
    }

    public function destroy($id)
    {
        Goal::findOrFail($id)->delete();
        return redirect()->route('goal.index')->with('success', 'Goals dihapus!');
    }
}



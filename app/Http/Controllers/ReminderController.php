<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::where('user_id', auth()->id())
            ->orderBy('date', 'asc')
            ->get();

        return view('reminder.index', compact('reminders'));
    }

    public function create()
    {
        return view('reminder.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'date'  => 'required|date',
            'note'  => 'nullable|string',
        ]);

        Reminder::create([
            'user_id' => auth()->id(),
            'title'   => $request->title,
            'date'    => $request->date,
            'note'    => $request->note,
        ]);

        return redirect()->route('reminder.index')
            ->with('success', 'Reminder berhasil ditambahkan');
    }

    public function edit($id)
    {
        $reminder = Reminder::where('user_id', auth()->id())
            ->findOrFail($id);

        return view('reminder.edit', compact('reminder'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'date'  => 'required|date',
            'note'  => 'nullable|string',
        ]);

        $reminder = Reminder::where('user_id', auth()->id())
            ->findOrFail($id);

        $reminder->update([
            'title' => $request->title,
            'date'  => $request->date,
            'note'  => $request->note,
        ]);

        return redirect()->route('reminder.index')
            ->with('success', 'Reminder berhasil diperbarui');
    }

    public function destroy($id)
    {
        $reminder = Reminder::where('user_id', auth()->id())
            ->findOrFail($id);

        $reminder->delete();

        return redirect()->route('reminder.index')
            ->with('success', 'Reminder berhasil dihapus');
    }
}

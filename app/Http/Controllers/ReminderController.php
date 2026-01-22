<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::where('user_id', auth()->id())
            ->orderBy('remind_date', 'asc')
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
            'title' => 'required|string',
            'remind_date' => 'required|date'
        ]);

        Reminder::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'remind_date' => $request->remind_date
        ]);

        return redirect()->route('reminder.index')
            ->with('success', 'Reminder berhasil ditambahkan');
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

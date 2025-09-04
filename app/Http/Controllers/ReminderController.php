<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use App\Models\ReminderCategory;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reminders-admin.index', [
            'title'    => 'Reminders admin',
            'reminders'=> Reminder::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'category_id'      => 'required|exists:reminder_categories,id',
            'due_date'         => 'nullable|date',
            'description'      => 'nullable|string',
            'recipient_emails' => 'nullable|string',
            'recipient_phones' => 'nullable|string',
        ]);

        // minimal salah satu diisi
        if (empty($validated['recipient_emails']) && empty($validated['recipient_phones'])) {
            return back()->withErrors([
                'recipient_emails' => 'Isi minimal satu email atau phone.'
            ]);
        }

        // simpan jadi array JSON
        $validated['recipient_emails'] = !empty($validated['recipient_emails'])
            ? array_map('trim', explode(',', $validated['recipient_emails']))
            : null;

        $validated['recipient_phones'] = !empty($validated['recipient_phones'])
            ? array_map('trim', explode(',', $validated['recipient_phones']))
            : null;

        Reminder::create($validated);

        return redirect()
            ->route('reminders-admin.index')
            ->with('success', 'Reminder berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

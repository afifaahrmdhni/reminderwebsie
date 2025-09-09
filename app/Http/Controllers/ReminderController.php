<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use App\Models\ReminderCategory;

class ReminderController extends Controller
{
    /**
     * Display a listing of reminders.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all'); // default "all"
        $today  = \Carbon\Carbon::today();

        $reminders = Reminder::with('category')
            ->latest()
            ->get()
            ->filter(function($reminder) use ($status, $today) {
                $due = $reminder->due_date ? \Carbon\Carbon::parse($reminder->due_date) : null;
                $daysLeft = $due ? $today->diffInDays($due, false) : null;

                if (is_null($due)) {
                    $reminderStatus = 'nodate';
                } elseif ($daysLeft > 14) {
                    $reminderStatus = 'active';
                } elseif ($daysLeft > 7) {
                    $reminderStatus = 'upcoming';
                } elseif ($daysLeft >= 0) {
                    $reminderStatus = 'urgent';
                } else {
                    $reminderStatus = 'expired';
                }

                return $status === 'all' || $status === $reminderStatus;
            });

        return view('reminders-admin.index', [
            'title'      => 'Reminders Admin',
            'reminders'  => $reminders,
            'categories' => ReminderCategory::all(),
            'status'     => $status, // biar bisa tahu dropdown mana yang kepilih
        ]);
    }

    /**
     * Store a newly created reminder.
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

        // Wajib minimal 1 kontak diisi
        if (empty($validated['recipient_emails']) && empty($validated['recipient_phones'])) {
            return back()->withErrors([
                'recipient_emails' => 'Isi minimal satu email atau nomor telepon.',
            ]);
        }

        // Simpan jadi array JSON (auto ke cast di model jika pakai casts json)
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
     * Show the form for editing the specified reminder.
     */
    public function edit(Reminder $reminder)
    {
        return view('reminders-admin.edit', [
            'reminder'   => $reminder,
            'categories' => ReminderCategory::all(),
        ]);
    }


    public function createMessageForm() {
    $users = User::select('email', 'phone')->get();
    return view('reminder-admin.create', compact('reminders'));
}

    /**
     * Update the specified reminder.
     */
    public function update(Request $request, Reminder $reminder)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'category_id'      => 'required|exists:reminder_categories,id',
            'due_date'         => 'nullable|date',
            'description'      => 'nullable|string',
            'recipient_emails' => 'nullable|string',
            'recipient_phones' => 'nullable|string',
        ]);

        if (empty($validated['recipient_emails']) && empty($validated['recipient_phones'])) {
            return back()->withErrors([
                'recipient_emails' => 'Isi minimal satu email atau nomor telepon.',
            ]);
        }

        $validated['recipient_emails'] = !empty($validated['recipient_emails'])
            ? array_map('trim', explode(',', $validated['recipient_emails']))
            : null;

        $validated['recipient_phones'] = !empty($validated['recipient_phones'])
            ? array_map('trim', explode(',', $validated['recipient_phones']))
            : null;

        $reminder->update($validated);

        return redirect()
            ->route('reminders-admin.index')
            ->with('success', 'Reminder berhasil diperbarui!');
    }

    /**
     * Remove the specified reminder.
     */
    public function destroy(Reminder $reminder)
    {
        $reminder->delete();

        return redirect()
            ->route('reminders-admin.index')
            ->with('success', 'Reminder berhasil dihapus!');
    }
}

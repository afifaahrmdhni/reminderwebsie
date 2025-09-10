<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use App\Models\ReminderCategory;
use App\Models\User;

class ReminderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all'); 
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
            'status'     => $status,
        ]);
    }

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

        Reminder::create($validated);

        return redirect()
            ->route('reminders-admin.index')
            ->with('success', 'Reminder berhasil dibuat!');
    }

    public function edit(Reminder $reminder)
    {
        return view('reminders-admin.edit', [
            'reminder'   => $reminder,
            'categories' => ReminderCategory::all(),
        ]);
    }

    public function createMessageForm() {
        $users = User::select('email', 'phone')->get();
        return view('reminder-admin.create', compact('users'));
    }

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

    public function destroy(Reminder $reminder)
    {
        $reminder->delete();
        return redirect()
            ->route('reminders-admin.index')
            ->with('success', 'Reminder berhasil dipindahkan ke Archive!');
    }

    public function archive()
    {
        $reminders = Reminder::onlyTrashed()->get();
        return view('archive-admin.index', compact('reminders'));
    }

    public function restore($id)
    {
        $reminder = Reminder::onlyTrashed()->findOrFail($id);
        $reminder->restore();

        return redirect()->route('archive-admin.index')
            ->with('success', 'Reminder berhasil direstore!');
    }

    public function forceDelete($id)
    {
        $reminder = Reminder::onlyTrashed()->findOrFail($id);
        $reminder->forceDelete();

        return redirect()->route('archive-admin.index')
            ->with('success', 'Reminder dihapus permanen!');
    }
}

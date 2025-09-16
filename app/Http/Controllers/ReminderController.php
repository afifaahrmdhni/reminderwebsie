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
        // Validasi field umum dulu
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:reminder_categories,id',
            'due_date'    => 'nullable|date',
            'description' => 'nullable|string',
            // NOTE: recipient fields divalidasi manual di bawah (karena bisa 2 format)
        ]);

        // Helper: ambil emails dari request (bisa array atau comma string)
        $emails = [];
        if ($request->has('recipient_email')) { // array inputs nama: recipient_email[]
            if (is_array($request->recipient_email)) {
                foreach ($request->recipient_email as $e) {
                    $e = trim($e);
                    if ($e !== '') $emails[] = $e;
                }
            } elseif (is_string($request->recipient_email)) {
                // unlikely, tapi aman
                $emails = array_filter(array_map('trim', explode(',', $request->recipient_email)));
            }
        } elseif ($request->filled('recipient_emails')) { // alternative name: recipient_emails (comma string)
            $emails = array_filter(array_map('trim', explode(',', $request->recipient_emails)));
        }

        // Helper: ambil phones (array atau comma string)
        $phones = [];
        if ($request->has('recipient_phone')) {
            if (is_array($request->recipient_phone)) {
                foreach ($request->recipient_phone as $p) {
                    $p = trim($p);
                    if ($p !== '') $phones[] = $p;
                }
            } elseif (is_string($request->recipient_phone)) {
                $phones = array_filter(array_map('trim', explode(',', $request->recipient_phone)));
            }
        } elseif ($request->filled('recipient_phones')) {
            $phones = array_filter(array_map('trim', explode(',', $request->recipient_phones)));
        }

        // Validasi email (manual) jika ada
        foreach ($emails as $e) {
            if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
                return back()->withErrors(['recipient_emails' => "Email tidak valid: {$e}"])->withInput();
            }
        }

        // Minimal salah satu harus ada
        if (empty($emails) && empty($phones)) {
            return back()->withErrors([
                'recipient_emails' => 'Isi minimal satu email atau nomor telepon.'
            ])->withInput();
        }

        // Simpan (model cast array -> json)
        Reminder::create([
            'title'            => $request->title,
            'category_id'      => $request->category_id,
            'due_date'         => $request->due_date,
            'description'      => $request->description,
            'recipient_emails' => array_values(array_unique($emails)),
            'recipient_phones' => array_values(array_unique($phones)),
        ]);

        return redirect()->route('reminders-admin.index')
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
        // Validasi field umum dulu
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:reminder_categories,id',
            'due_date'    => 'nullable|date',
            'description' => 'nullable|string',
            // recipient fields validated manually below
        ]);

        // Parse emails (sama logic seperti store)
        $emails = [];
        if ($request->has('recipient_email')) {
            if (is_array($request->recipient_email)) {
                foreach ($request->recipient_email as $e) {
                    $e = trim($e);
                    if ($e !== '') $emails[] = $e;
                }
            } elseif (is_string($request->recipient_email)) {
                $emails = array_filter(array_map('trim', explode(',', $request->recipient_email)));
            }
        } elseif ($request->filled('recipient_emails')) {
            $emails = array_filter(array_map('trim', explode(',', $request->recipient_emails)));
        } else {
            // Kalau tidak ada field sama sekali -> pakai yang lama (biar edit tanpa mengisi tetap aman)
            $emails = $reminder->recipient_emails ?? [];
        }

        // Parse phones
        $phones = [];
        if ($request->has('recipient_phone')) {
            if (is_array($request->recipient_phone)) {
                foreach ($request->recipient_phone as $p) {
                    $p = trim($p);
                    if ($p !== '') $phones[] = $p;
                }
            } elseif (is_string($request->recipient_phone)) {
                $phones = array_filter(array_map('trim', explode(',', $request->recipient_phone)));
            }
        } elseif ($request->filled('recipient_phones')) {
            $phones = array_filter(array_map('trim', explode(',', $request->recipient_phones)));
        } else {
            $phones = $reminder->recipient_phones ?? [];
        }

        // Validasi email entries
        foreach ($emails as $e) {
            if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
                return back()->withErrors(['recipient_emails' => "Email tidak valid: {$e}"])->withInput();
            }
        }

        // Minimal satu
        if (empty($emails) && empty($phones)) {
            return back()->withErrors([
                'recipient_emails' => 'Isi minimal satu email atau nomor telepon.'
            ])->withInput();
        }

        // Update (replace)
        $reminder->update([
            'title'            => $request->title,
            'category_id'      => $request->category_id,
            'due_date'         => $request->due_date,
            'description'      => $request->description,
            'recipient_emails' => array_values(array_unique($emails)),
            'recipient_phones' => array_values(array_unique($phones)),
        ]);

        return redirect()->route('reminders-admin.index')
            ->with('success', 'Reminder berhasil diupdate!');
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

<?php

namespace App\Http\Controllers;

use App\Models\Reminder;

class ArchiveController extends Controller
{
    public function index()
    {
        $reminders = Reminder::onlyTrashed()->get(); // ambil yang di-soft delete
        return view('archive-admin.index', compact('reminders'));
    }

    public function restore($id)
    {
        $reminder = Reminder::withTrashed()->findOrFail($id);
        $reminder->restore();

        return redirect()->route('archive-admin.index')->with('success', 'Reminder berhasil direstore.');
    }

    public function forceDelete($id)
    {
        $reminder = Reminder::withTrashed()->findOrFail($id);
        $reminder->forceDelete();

        return redirect()->route('archive-admin.index')->with('success', 'Reminder dihapus permanen.');
    }

}

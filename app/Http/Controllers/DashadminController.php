<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reminder;

class DashadminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    return view('dashboard-admin.index', [
        'title' => 'Dashboard',
        'totalUsers' => User::count(),
        'totalReminders' => Reminder::count(),
        // jumlah yang jatuh tempo dalam 7 hari
        'duesoonReminders' => Reminder::whereNotNull('due_date')
            ->whereBetween('due_date', [now(), now()->addDays(7)])
            ->count(),

        // 3 reminder urgent (due dalam 7 hari), eager-load kategori
        'urgentReminders' => Reminder::whereNotNull('due_date')
            ->whereBetween('due_date', [now(), now()->addDays(7)])
            ->with('category')
            ->orderBy('due_date', 'asc')
            ->take(3)
            ->get(),

        // 5 reminder terbaru berdasarkan created_at
        'latestReminders' => Reminder::with('category')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get(),

        // 3 reminder expired (due_date < now)
        'expiredReminders' => Reminder::whereNotNull('due_date')
            ->where('due_date', '<', now())
            ->with('category')
            ->orderBy('due_date', 'desc')
            ->take(3)
            ->get(),
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('Dashboard.user', [
            'title' => 'User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

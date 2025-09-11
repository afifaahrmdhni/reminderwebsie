<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = ['Admin', 'Super User', 'Multi User', 'Basic User']; // roles string

        return view('users-admin.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|min:10|max:20',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);
        Log::info('STORE DATA', $request->all());
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        return redirect()->route('users-admin.index')->with('success', 'User berhasil ditambahkan');
    }

    public function searchEmail(Request $request)
{
    $search = $request->get('q');

    $users = User::where('email', 'LIKE', "%{$search}%")
        ->limit(10)
        ->get(['email', 'phone']);

    return response()->json($users);
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|min:10|max:20',
            'role' => 'required|string',
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users-admin.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users-admin.index')->with('success', 'User berhasil dihapus');
    }
}

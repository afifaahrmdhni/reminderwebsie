<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    // public function edit()
    // {
    //     return view('u-profile.index');
    // }

    // public function update(Request $request)
    // {
    //     $user = auth()->user();

    //     $request->validate([
    //         'name'  => 'required|string|max:100',
    //         'email' => 'required|email|unique:users,email,' . $user->id,
    //         'phone' => 'nullable|string|max:20',
    //         'photo' => 'nullable|image|max:2048',
    //     ]);

    //     $data = $request->only(['name', 'email', 'phone']);

    //     if ($request->hasFile('photo')) {
    //         if ($user->photo) {
    //             Storage::delete('public/' . $user->photo);
    //         }
    //         $path = $request->file('photo')->store('photos', 'public');
    //         $data['photo'] = $path;
    //     }

    //     $user->update($data);

    //     return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    // }
}

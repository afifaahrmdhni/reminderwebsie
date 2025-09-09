@extends('backend.master')

@section('sidebar')
    @include('backend.sidebar')
@endsection

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Manage Users</h2>

    {{-- Form Tambah User --}}
    <div class="card p-4 mb-4 shadow rounded">
        <h3 class="text-lg font-semibold mb-3">Add New User</h3>

        <form action="{{ route('users-admin.store') }}" method="POST">
            @csrf

            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

             {{-- Nomor Whatsapp --}}
            <div class="mb-3">
                <label for="whatsapp" class="form-label">Nomor Whatsaap</label>
                <input type="text" class="form-control" id="whatsapp" name="phone" required>
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            {{-- Role --}}
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role_id" name="role_id" required>
                    <option value="" disabled selected>-- Select Role --</option>
                    <option value="1">Super User</option>
                    <option value="2">Multi User</option>
                    <option value="3">Basic User</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>

    {{-- Table daftar user --}}
    <div class="card p-4 shadow rounded">
        <h3 class="text-lg font-semibold mb-3">User List</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Nomor</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role_name }}</td> {{-- sudah auto-convert pakai accessor --}}
                        <td>{{ $user->phone }}</td>
                        <td class="px-6 py-4 text-sm text-center">
                            <div class="flex items-center justify-center space-x-2">
                                {{-- Tombol Edit --}}
                                <a href=""
                                class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50 transition-colors">
                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                </a>

                                {{-- Tombol Delete --}}
                                <form action=""
                                    method="POST"
                                    onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50 transition-colors">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

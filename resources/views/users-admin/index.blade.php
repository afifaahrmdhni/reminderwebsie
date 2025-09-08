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
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role_name }}</td> {{-- sudah auto-convert pakai accessor --}}
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

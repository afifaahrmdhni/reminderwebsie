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
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th style="width: 50px;">#</th>
                    <th style="width: 180px;">Name</th>
                    <th style="width: 200px;">Email</th>
                    <th style="width: 150px;">Role</th>
                    <th style="width: 150px;">Nomor</th>
                    <th style="width: 120px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role_name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">

                                {{-- Tombol Edit --}}
                                <button type="button"
                                        class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editUserModal{{ $user->id }}">
                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                </button>

                                {{-- Tombol Delete --}}
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteUserModal{{ $user->id }}">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('users-admin.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nomor WhatsApp</label>
                                            <input type="tel" name="phone" value="{{ $user->phone }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Role</label>
                                            <select name="role_id" class="form-select" required>
                                                <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Super User</option>
                                                <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Multi User</option>
                                                <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Basic User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Delete --}}
                    <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('users-admin.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus user <strong>{{ $user->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="6" class="text-center">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

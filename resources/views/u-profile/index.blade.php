@extends('backend.master')

@section('sidebar')
  @include('backend.sidebar')
@endsection

@section('navbar')
  @include('backend.navbar')
@endsection

@section('content')
<div class="max-w-3xl mx-auto mt-8">
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Profil Saya</h2>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Foto Profil --}}
            <div class="flex items-center gap-4">
                <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-200">
                    @if (auth()->user()->photo)
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" 
                             alt="Foto Profil" class="w-full h-full object-cover">
                    @else
                        <span class="flex items-center justify-center h-full text-gray-500">No Photo</span>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Ubah Foto</label>
                    <input type="file" name="photo" accept="image/*" class="mt-1 block w-full text-sm">
                </div>
            </div>

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            {{-- No. Telepon --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            {{-- Role User --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Jenis User</label>
                <input type="text" value="{{ auth()->user()->role_name }}" readonly
                       class="mt-1 block w-full rounded-md border-gray-200 bg-gray-100 cursor-not-allowed">
            </div>

            {{-- Tombol --}}
            <div class="pt-4">
                <button type="submit" class="px-5 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

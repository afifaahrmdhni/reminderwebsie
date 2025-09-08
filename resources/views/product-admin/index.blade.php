@extends ('backend.master')

@section ('sidebar')
    @include('backend.sidebar')
@endsection

@section ('content')
<div class="mt-20 bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-lg font-semibold text-gray-800">Kategori/Product Terbaru</h3>
            <button class="btn btn-primary" style="margin-right: 15px;" data-bs-toggle="modal" data-bs-target="#categoryModal">
                <i class="fa-solid fa-plus me-1"></i> Tambah Produk/Kategori
            </button>
        </div>

        {{-- include modal create --}}
        @include('product-admin.create')
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-700 text-start">Nama</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-700 text-start">Deskripsi</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-700 text-center">Jumlah Reminder</th>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-700 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($datas as $item)
                <tr class="hover:bg-gray-50 transition">
                    {{-- Nama --}}
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        {{ $item->name }}
                    </td>

                    {{-- Deskripsi --}}
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $item->deskripsi ?? '-' }}
                    </td>

                    {{-- Jumlah Reminder (misal relasi reminders) --}}
                    <td class="px-6 py-4 text-sm text-center">
                        {{ $item->reminders->count() ?? 0 }}
                    </td>

                    {{-- Action --}}
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
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        Belum ada data produk/kategori.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

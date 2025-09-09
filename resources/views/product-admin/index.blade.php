@extends ('backend.master')

@section ('sidebar')
    @include('backend.sidebar')
@endsection

@section ('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-lg font-semibold text-gray-800">Kategori/Product Terbaru</h3>
            <button class="btn btn-primary" style="margin-right: 15px;" data-bs-toggle="modal" data-bs-target="#categoryModal">
                <i class="fa-solid fa-plus me-1"></i> Tambah Produk/Kategori
            </button>
        </div>

        {{-- Modal Create --}}
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

                    {{-- Jumlah Reminder --}}
                    <td class="px-6 py-4 text-sm text-center">
                        {{ $item->reminders->count() ?? 0 }}
                    </td>

                    {{-- Action --}}
                    <td class="px-6 py-4 text-sm text-center">
                        <div class="flex items-center justify-center space-x-2">
                            {{-- Tombol Edit --}}
                            <button type="button"
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editCategoryModal{{ $item->id }}">
                                Edit
                            </button>

                            {{-- Tombol Delete (pakai modal konfirmasi) --}}
                            <button type="button"
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal" 
                                data-bs-target="#confirmDeleteModal"
                                onclick="setDeleteAction('{{ route('product-admin.destroy', $item->id) }}')">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>

                {{-- Modal Edit --}}
                @include('product-admin.edit', ['item' => $item])

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

{{-- Modal Konfirmasi Delete (hanya sekali) --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah kamu yakin ingin menghapus kategori ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form id="deleteForm" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Ya, Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Script kecil --}}
<script>
function setDeleteAction(url) {
    document.getElementById('deleteForm').action = url;
}
</script>
@endsection

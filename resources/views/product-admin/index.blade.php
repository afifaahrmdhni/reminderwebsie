@extends ('backend.master')
@section ('sidebar')
@include('backend.sidebar')
@endsection
@section ('content')

            <!-- Recent Customers -->
            <div class="mt-20 bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="d-flex justify-content-between align-items-center">
                    <h3 class="text-lg font-semibold text-gray-800">Kategori/Product Terbaru</h3>
                    <span class="btn btn-primary" style="margin-right: 15px;" data-bs-toggle="modal" data-bs-target="#categoryModal">
                    <i class="fa-solid fa-plus" style="margin-right:  2px"></i>
                    Tambah Produk/Kategori</span>
                    </div>

                    {{-- include modal --}}
                    @include('product-admin.create')
                </div>
                <div class="overflow-x-auto">
                    <table class="table-auto w-full border-collapse">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-700 text-start">Nama</th>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-700 text-start">Icon / Gambar</th>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-700 text-center">Jumlah Reminder</th>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-700 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($datas as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->name }}</td>

                                <td class="px-6 py-4 text-sm text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                         <button class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50 transition-colors" onclick="editUser(3)">
                                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                                </button>
                                        <form action="" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 text-sm rounded bg-red-500 text-white hover:bg-red-600">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
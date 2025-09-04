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
                    Add Product/Kategori</span>
                    </div>

                    {{-- include modal --}}
                    @include('product-admin.create')
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon/Gambar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Reminder</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- @foreach ($datas as $data) --}}
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Karina</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">fasfas</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">15</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <div class="flex space-x-2">
                                        <!-- Tombol Edit -->
                                        <a href="" 
                                        {{-- {{ route('edit', $item->id) }} --}}
                                        class="px-3 py-1 text-sm rounded bg-yellow-500 text-white hover:bg-yellow-600">
                                            Edit
                                        </a>

                                        <!-- Tombol Delete -->
                                        <form action="" 
                                        {{-- {{ route('delete', $item->id) }} --}}
                                        method="POST"
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
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
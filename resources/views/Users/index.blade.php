@extends ('backend.master')
@section ('sidebar')
@include('backend.sidebar')
@endsection

@section ('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Tambah User Baru</h3>
                        </div>
                        
                        <div class="p-6">
                            <form id="user-form" class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                        <input type="text" id="nama" name="nama" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                               placeholder="Masukkan nama lengkap">
                                    </div>
                                    
                                    <div>
                                        <label for="no-telp" class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                                        <input type="tel" id="no-telp" name="no-telp" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                               placeholder="08xxxxxxxxxx">
                                    </div>
                                    
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                        <input type="email" id="email" name="email" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                               placeholder="user@email.com">
                                    </div>
                                </div>
                                
                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                        <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                                        Tambah User
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

            {{-- list users --}}
 <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Daftar User Terdaftar</h3>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Telepon</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="users-table-body" class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                                    <span class="text-white font-medium">AS</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Ahmad Sutrisno</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">081234567890</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">ahmad.sutrisno@email.com</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Aktif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <button class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50 transition-colors" onclick="editUser(0)">
                                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50 transition-colors" onclick="deleteUser(0)">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center">
                                                    <span class="text-white font-medium">SP</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Sari Purnama</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">081987654321</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">sari.purnama@email.com</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Aktif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <button class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50 transition-colors" onclick="editUser(1)">
                                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50 transition-colors" onclick="deleteUser(1)">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                                    <span class="text-white font-medium">BH</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Budi Hartono</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">081555666777</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">budi.hartono@email.com</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <button class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50 transition-colors" onclick="editUser(2)">
                                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50 transition-colors" onclick="deleteUser(2)">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center">
                                                    <span class="text-white font-medium">DF</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Dewi Fitriani</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">081333444555</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">dewi.fitriani@email.com</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <button class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50 transition-colors" onclick="editUser(3)">
                                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50 transition-colors" onclick="deleteUser(3)">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

@endsection
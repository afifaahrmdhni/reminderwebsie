<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Windster - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#10B981'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Sidebar -->
  @yield('sidebar')

    <!-- Mobile menu button -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="mobile-menu-btn" class="p-2 bg-white rounded-lg shadow-md">
            <i class="fas fa-bars text-gray-600"></i>
        </button>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen">
        <!-- Header -->
        @yield('navbar')

        <!-- Dashboard Content -->
       @yield('content')
{{-- 
    <script>
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobile-overlay');

        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            mobileOverlay.classList.toggle('hidden');
        });

        mobileOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            mobileOverlay.classList.add('hidden');
        });

        // Initialize mobile sidebar as hidden
        if (window.innerWidth < 1024) {
            sidebar.classList.add('-translate-x-full');
        }

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                mobileOverlay.classList.add('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // User management data
        let users = [
            { id: 1, name: 'Andi Setiawan', email: 'andi.setiawan@email.com', phone: '081234567890', status: 'Aktif', initials: 'AS', color: 'bg-blue-500' },
            { id: 2, name: 'Sari Putri', email: 'sari.putri@email.com', phone: '082345678901', status: 'Aktif', initials: 'SP', color: 'bg-purple-500' },
            { id: 3, name: 'Budi Wijaya', email: 'budi.wijaya@email.com', phone: '083456789012', status: 'Pending', initials: 'BW', color: 'bg-orange-500' }
        ];
        let editingUserId = null;

        // Function to generate initials
        function getInitials(name) {
            return name.split(' ').map(word => word[0]).join('').toUpperCase();
        }

        // Function to get random color
        function getRandomColor() {
            const colors = ['bg-blue-500', 'bg-purple-500', 'bg-orange-500', 'bg-pink-500', 'bg-indigo-500', 'bg-green-500', 'bg-red-500'];
            return colors[Math.floor(Math.random() * colors.length)];
        }

        // Function to render users table
        function renderUsersTable() {
            const tbody = document.getElementById('users-table-body');
            tbody.innerHTML = users.map(user => `
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 ${user.color} rounded-full flex items-center justify-center">
                                <span class="text-white font-medium">${user.initials}</span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${user.name}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${user.email}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${user.phone}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium ${user.status === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'} rounded-full">${user.status}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button onclick="editUser(${user.id})" class="text-primary hover:text-blue-700 mr-3 transition-colors">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button onclick="deleteUser(${user.id})" class="text-red-600 hover:text-red-800 transition-colors">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        // Function to edit user
        function editUser(id) {
            const user = users.find(u => u.id === id);
            if (user) {
                document.getElementById('user-name').value = user.name;
                document.getElementById('user-email').value = user.email;
                document.getElementById('user-phone').value = user.phone;
                editingUserId = id;
                
                // Change button text
                const submitBtn = document.querySelector('#user-form button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i>Update Pengguna';
                
                // Scroll to form
                document.getElementById('user-form').scrollIntoView({ behavior: 'smooth' });
            }
        }

        // Function to delete user
        function deleteUser(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                users = users.filter(u => u.id !== id);
                renderUsersTable();
            }
        }

        // Handle form submission
        document.getElementById('user-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('user-name').value;
            const email = document.getElementById('user-email').value;
            const phone = document.getElementById('user-phone').value;
            
            if (editingUserId) {
                // Update existing user
                const userIndex = users.findIndex(u => u.id === editingUserId);
                if (userIndex !== -1) {
                    users[userIndex] = {
                        ...users[userIndex],
                        name,
                        email,
                        phone,
                        initials: getInitials(name)
                    };
                }
                editingUserId = null;
                
                // Reset button text
                const submitBtn = document.querySelector('#user-form button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-plus mr-2"></i>Tambah Pengguna';
            } else {
                // Add new user
                const newUser = {
                    id: Math.max(...users.map(u => u.id)) + 1,
                    name,
                    email,
                    phone,
                    status: 'Aktif',
                    initials: getInitials(name),
                    color: getRandomColor()
                };
                users.push(newUser);
            }
            
            // Reset form and render table
            this.reset();
            renderUsersTable();
        });

        // Add click functionality to navigation items
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Remove active class from all links
                document.querySelectorAll('nav a').forEach(l => {
                    l.classList.remove('bg-blue-50', 'text-gray-700');
                    l.classList.add('text-gray-600');
                });
                
                // Add active class to clicked link (except upgrade to pro)
                if (!link.classList.contains('bg-gradient-to-r')) {
                    link.classList.add('bg-blue-50', 'text-gray-700');
                    link.classList.remove('text-gray-600');
                }
                
                // Get the page name from the link text
                const pageName = link.textContent.trim();
                
                // Show/hide content based on navigation
                const dashboardContent = document.getElementById('dashboard-content');
                const usersContent = document.getElementById('users-content');
                const pageTitle = document.getElementById('page-title');
                const pageSubtitle = document.getElementById('page-subtitle');
                
                if (pageName === 'Users') {
                    dashboardContent.classList.add('hidden');
                    usersContent.classList.remove('hidden');
                    pageTitle.textContent = 'Manajemen Pengguna';
                    pageSubtitle.textContent = 'Kelola data pengguna sistem Windster';
                } else if (pageName === 'Dashboard') {
                    dashboardContent.classList.remove('hidden');
                    usersContent.classList.add('hidden');
                    pageTitle.textContent = 'Dashboard';
                    pageSubtitle.textContent = 'Selamat datang kembali! Berikut ringkasan aktivitas hari ini.';
                } else {
                    // For other pages, show dashboard for now
                    dashboardContent.classList.remove('hidden');
                    usersContent.classList.add('hidden');
                    pageTitle.textContent = pageName;
                    pageSubtitle.textContent = `Halaman ${pageName} sedang dalam pengembangan`;
                }
                
                // Close mobile menu if open
                if (window.innerWidth < 1024) {
                    sidebar.classList.add('-translate-x-full');
                    mobileOverlay.classList.add('hidden');
                }
            });
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'972a879fb2174acd',t:'MTc1NTc4MzQ5Ni4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html> --}}

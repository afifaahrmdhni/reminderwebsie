<!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out" id="sidebar">
        <div class="flex items-center justify-center h-16 bg-primary">
            <h1 class="text-xl font-bold text-white">Windster</h1>
        </div>
        
        <nav class="mt-8">
            <div class="px-4 space-y-2">
                <a href="{{ route('Dashboard.index') }}" class="flex items-center px-4 py-3 text-gray-700 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                    <i class="fas fa-tachometer-alt w-5 h-5 mr-3 text-primary"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('Users.index') }}" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-users w-5 h-5 mr-3"></i>
                    <span>Users</span>
                </a>
                
                <a href="{{ route('Products.index') }}" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-box w-5 h-5 mr-3"></i>
                    <span>Product</span>
                </a>
                
            
        </nav>
    </div>

    <!-- Mobile menu button -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="mobile-menu-btn" class="p-2 bg-white rounded-lg shadow-md">
            <i class="fas fa-bars text-gray-600"></i>
        </button>
    </div>
<header class="bg-white shadow-sm border-b border-gray-200">
  <div class="px-6 py-4">
    <div class="flex items-center justify-between">
      <!-- Left -->
      <div class="flex items-center space-x-4">
        <button id="toggle-sidebar" class="p-2 text-gray-600 hover:bg-gray-100 rounded-md">
          <i class="fas fa-bars text-xl"></i>
        </button>
        <div>
          <h2 class="text-2xl font-bold text-gray-800" id="page-title">
            Hello, {{ Auth::user()->name }}!
          </h2>
          <p class="text-gray-600 mt-1" id="page-subtitle">
            Oi {{ Auth::user()->name }}, selamat datang kembali 👋
          </p>
        </div>
      </div>

      <!-- Right -->
      <div class="flex items-center space-x-4">
        <div class="w-12 h-12 rounded-full overflow-hidden">
          <img src="img/etmin.jpeg" >
        </div>
        <p>{{ Auth::user()->name }}</p>
         <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors">
          <i class="fas fa-bell text-xl"></i>
        </button>
      </div>
    </div>
  </div>
</header>

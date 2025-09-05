<header class="bg-white shadow-sm border-b border-gray-200">
  <div class="px-6 py-4">
    <div class="flex items-center justify-between">
      <!-- Left -->
      <div class="flex items-center space-x-4">
        <button id="toggle-sidebar" class="p-2 text-gray-600 hover:bg-gray-100 rounded-md">
          <i class="fas fa-bars text-xl"></i>
        </button>
        <div>
          <h2 class="text-2xl font-bold text-gray-800" id="page-title">Hello, etmin!</h2>
          <p class="text-gray-600 mt-1" id="page-subtitle">
            Oi etmin, lu ngapain di marih....
          </p>
        </div>
      </div>

      <!-- Right -->
      <div class="flex items-center space-x-4">
        <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors">
          <i class="fas fa-bell text-xl"></i>
        </button>
        <div class="w-12 h-12 rounded-full overflow-hidden">
          <img src="img/etmin.jpeg" >
        </div>
      </div>
    </div>
  </div>
</header>


{{-- <!-- Navbar -->
<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="px-6 py-4">
        <div class="flex items-center justify-between">
            
            <!-- Kiri: Hamburger + Title -->
            <div class="flex items-center space-x-4">
                <!-- Tombol Hamburger -->
                <button id="toggle-sidebar" class="p-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Judul -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800" id="page-title">Dashboard</h2>
                    <p class="text-gray-600 mt-1" id="page-subtitle">
                        Selamat datang kembali! Berikut ringkasan aktivitas hari ini.
                    </p>
                </div>
            </div>

            <!-- Kanan -->
            <div class="flex items-center space-x-4">
                <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-bell text-xl"></i>
                </button>
                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                    <span class="text-white text-sm font-medium">A</span>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
  const sidebar = document.getElementById('sidebar');
  const content = document.getElementById('content');
  const toggleBtn = document.getElementById('toggle-sidebar');
  const links = document.querySelectorAll('#sidebar .nav-link');
  const pageTitle = document.getElementById('page-title');

  // Toggle sidebar
  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('closed');
    content.classList.toggle('full');
  });

  // Klik link -> active & close sidebar
  links.forEach(link => {
    link.addEventListener('click', e => {
      links.forEach(l => l.classList.remove('active'));
      link.classList.add('active');
      pageTitle.textContent = link.dataset.title;
      sidebar.classList.add('closed');
      content.classList.add('full');
    });
  });
</script>
 --}}

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
             {{ Auth::user()->name }}, selamat datang kembali 👋
          </p>
        </div>
      </div>

      
<!-- Right -->
<div class="relative" id="userDropdownWrapper">
    <div class="flex items-center space-x-2 cursor-pointer" id="userDropdownToggle">
        <p class="font-medium text-gray-700">{{ Auth::user()->name }}</p>
        <i class="fa-solid fa-circle-user text-2xl text-gray-500"></i>
    </div>

    <!-- Dropdown -->
    <div id="userDropdown" 
         class="hidden absolute right-0 mt-3 w-60 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden z-50">

        <div class="px-4 py-3 bg-gray-50 border-b">
            <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
            <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
            <p class="text-sm text-gray-500">{{ Auth::user()->phone ?? 'No phone' }}</p>
        </div>

        <div class="p-2">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="flex items-center w-full px-3 py-2 text-sm text-red-600 rounded-lg hover:bg-red-50 transition">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.getElementById("userDropdownToggle");
        const dropdown = document.getElementById("userDropdown");
        const wrapper = document.getElementById("userDropdownWrapper");

        toggle.addEventListener("click", function () {
            dropdown.classList.toggle("hidden");
        });

        document.addEventListener("click", function (e) {
            if (!wrapper.contains(e.target)) {
                dropdown.classList.add("hidden");
            }
        });
    });
</script>

</header>

<div>
  <div class="d-flex align-items-center justify-content-center bg-primary text-white" style="height: 60px;">
    <h1 class="h5 fw-bold m-0">Reminders</h1>
  </div>

  <nav class="mt-3">
    <ul class="nav flex-column px-2">

      {{-- Semua role bisa akses Dashboard --}}
      <li class="nav-item">
        <a href="{{ route('dashboard-admin.index') }}" 
           class="nav-link px-3 py-2 rounded {{ request()->routeIs('dashboard-admin.index') ? 'active text-primary bg-blue-50' : 'text-dark' }}">
           <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
      </li>
      <li class="nav-item text-danger px-3">
  {{ Auth::id() }} - {{ Auth::user()->email }} - {{ Auth::user()->role }}
</li>

      @if(Auth::check())
        {{-- Hanya Admin --}}
        @if(Auth::user()->role === 'Admin')  
        <li class="nav-item">
          <a href="{{ route('users-admin.index') }}" 
             class="nav-link px-3 py-2 rounded {{ request()->routeIs('users-admin*') ? 'active text-primary bg-blue-50' : 'text-dark' }}">
             <i class="fas fa-users me-2"></i> Users
          </a>
        </li>
        @endif

        {{-- Admin, Super User, Multi User --}}
        @if(in_array(Auth::user()->role, ['Admin', 'Super User', 'Multi User']))
        <li class="nav-item">
          <a href="{{ route('product-admin.index') }}" 
             class="nav-link px-3 py-2 rounded {{ request()->routeIs('product-admin.*') ? 'active text-primary bg-blue-50' : 'text-dark' }}">
             <i class="fas fa-box me-2"></i> Kategori Product
          </a>
        </li>
        @endif

        {{-- Semua role bisa akses Reminders --}}
        <li class="nav-item">
          <a href="{{ route('reminders-admin.index') }}" 
             class="nav-link px-3 py-2 rounded {{ request()->routeIs('reminders-admin.*') ? 'active text-primary bg-blue-50' : 'text-dark' }}">
             <i class="fas fa-bell me-2"></i> Reminders
          </a>
        </li>

        {{-- Semua role bisa akses Archive --}}
        <li class="nav-item">
          <a href="{{ route('archive-admin.index') }}" 
             class="nav-link px-3 py-2 rounded {{ request()->routeIs('archive-admin.*') ? 'active text-primary bg-blue-50' : 'text-dark' }}">
             <i class="fas fa-archive me-2"></i> Archive
          </a>
        </li>
      @endif

    </ul>
  </nav>
</div>

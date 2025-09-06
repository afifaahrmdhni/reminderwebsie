<div>
  <div class="d-flex align-items-center justify-content-center bg-primary text-white" style="height: 60px;">
    <h1 class="h5 fw-bold m-0">Dashboard</h1>
  </div>
<nav class="mt-3">
  <ul class="nav flex-column px-2">
    <li class="nav-item">
      <a href="{{ route('dashboard-admin.index') }}" 
         class="nav-link px-3 py-2 rounded {{ request()->routeIs('dashboard-admin.index') ? 'active text-primary bg-blue-50' : 'text-dark' }}"
         data-title="Dashboard">
         <i class="fas fa-tachometer-alt me-2"></i> Dashboard
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('users-admin.index') }}" 
         class="nav-link px-3 py-2 rounded {{ request()->routeIs('users-admin*') ? 'active text-primary bg-blue-50' : 'text-dark' }}"
         data-title="Users-admin">
         <i class="fas fa-users me-2"></i> Users
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('products-admin.index') }}" 
         class="nav-link px-3 py-2 rounded {{ request()->routeIs('products-admin.*') ? 'active text-primary bg-blue-50' : 'text-dark' }}"
         data-title="Product admin">
         <i class="fas fa-box me-2"></i> Kategori Product
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('reminders-admin.index') }}" 
         class="nav-link px-3 py-2 rounded {{ request()->routeIs('reminders-admin.*') ? 'active text-primary bg-blue-50' : 'text-dark' }}"
         data-title="Reminders admin">
         <i class="fas fa-bell me-2"></i> Reminders
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('archive-admin.index') }}" 
         class="nav-link px-3 py-2 rounded {{ request()->routeIs('archive-admin.*') ? 'active text-primary bg-blue-50' : 'text-dark' }}"
         data-title="Archive admin">
         <i class="fas fa-archive me-2"></i> Archive
      </a>
    </li>
  </ul>
</nav>
</div>
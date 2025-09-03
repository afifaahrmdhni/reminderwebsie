<div>
  <div class="d-flex align-items-center justify-content-center bg-primary text-white" style="height: 60px;">
    <h1 class="h5 fw-bold m-0">Windster</h1>
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
      <a href="{{ route('users.index') }}" 
         class="nav-link px-3 py-2 rounded {{ request()->routeIs('users.*') ? 'active text-primary bg-blue-50' : 'text-dark' }}"
         data-title="Users">
         <i class="fas fa-users me-2"></i> Users
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('products.index') }}" 
         class="nav-link px-3 py-2 rounded {{ request()->routeIs('products.*') ? 'active text-primary bg-blue-50' : 'text-dark' }}"
         data-title="Product">
         <i class="fas fa-box me-2"></i> Product
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('reminders.index') }}" 
         class="nav-link px-3 py-2 rounded {{ request()->routeIs('reminders.*') ? 'active text-primary bg-blue-50' : 'text-dark' }}"
         data-title="Reminders">
         <i class="fas fa-bell me-2"></i> Reminders
      </a>
    </li>

    <li class="nav-item">
      <a href="" 
         class="nav-link px-3 py-2 rounded {{ request()->routeIs('archives.*') ? 'active text-primary bg-blue-50' : 'text-dark' }}"
         data-title="Archive">
         <i class="fas fa-archive me-2"></i> Archive
      </a>
    </li>
  </ul>
</nav>
</div>



{{-- <style>
    body {
      overflow-x: hidden;
    }
    #sidebar {
      width: 250px;
      transition: transform 0.3s ease-in-out;
    }
    #sidebar.closed {
      transform: translateX(-100%);
    }
    #content {
      transition: margin-left 0.3s ease-in-out;
      margin-left: 250px;
    }
    #content.full {
      margin-left: 0;
    }
    .nav-link.active {
      background-color: #e0edff;
      color: #2563eb !important;
      font-weight: 600;
    }
  </style>

<!-- Sidebar -->
<div class="position-fixed top-0 start-0 h-100 bg-white shadow-lg closed" id="sidebar">
  <div class="d-flex align-items-center justify-content-center bg-primary text-white" style="height: 60px;">
    <h1 class="h5 fw-bold m-0">Windster</h1>
  </div>
  <nav class="mt-3">
    <ul class="nav flex-column px-2">
      <li class="nav-item">
        <a href="{{ route('dashboard-admin.index') }}" 
           class="nav-link text-dark px-3 py-2 rounded"
           data-title="Dashboard">
           <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('users.index') }}" 
           class="nav-link text-dark px-3 py-2 rounded"
           data-title="Users">
           <i class="fas fa-users me-2"></i> Users
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('products.index') }}" 
           class="nav-link text-dark px-3 py-2 rounded"
           data-title="Product">
           <i class="fas fa-box me-2"></i> Product
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('reminders.index') }}" 
           class="nav-link text-dark px-3 py-2 rounded"
           data-title="Reminders">
           <i class="fas fa-bell me-2"></i> Reminders
        </a>
      </li>
      <li class="nav-item">
        <a href="" 
           class="nav-link text-dark px-3 py-2 rounded"
           data-title="Archive">
           <i class="fas fa-archive me-2"></i> Archive
        </a>
      </li>
    </ul>
  </nav>
</div> --}}

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('front-end/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('front-end/css/bootstrap-icons.css') }}">
  <style>
    body { overflow-x: hidden; }

    /* Sidebar */
    #sidebar {
      width: 250px;
      transition: transform 0.3s ease-in-out;
      background: #fff;
    }
    #sidebar.closed {
      transform: translateX(-100%);
    }

    /* Content */
    #content-wrapper {
      margin-left: 250px;
      transition: margin-left 0.3s ease-in-out;
    }
    #content-wrapper.full {
      margin-left: 0;
    }

    /* Active menu */
    .nav-link.active {
      background-color: #e0edff;
      color: #2563eb !important;
      font-weight: 600;
    }
  </style>
</head>
<body class="bg-gray-50 font-sans">

  <!-- Sidebar -->
  <div id="sidebar" class="position-fixed top-0 start-0 h-100 shadow-lg">
    @include('backend.sidebar')
  </div>

  <!-- Content -->
  <div id="content-wrapper">
    @include('backend.navbar')
    <div id="main-content" class="p-4">
      @yield('content')
    </div>
  </div>

  <script>
    const sidebar = document.getElementById("sidebar");
    const contentWrapper = document.getElementById("content-wrapper");
    const toggleBtn = document.getElementById("toggle-sidebar");
    const links = document.querySelectorAll('#sidebar .nav-link');
    const pageTitle = document.getElementById('page-title');

    if (toggleBtn) {
      toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("closed");
        contentWrapper.classList.toggle("full");
      });
    }

    // Handle klik link menu
    links.forEach(link => {
      link.addEventListener('click', e => {
        links.forEach(l => l.classList.remove('active'));
        link.classList.add('active');
        if (pageTitle) pageTitle.textContent = link.dataset.title;
      });
    });
  </script>

  <script src="{{ asset('front-end/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
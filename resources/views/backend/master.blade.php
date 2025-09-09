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

    #emailList {
    display: none; /* default tersembunyi */
    position: absolute;
    width: 90%; /* biar pas sama input */
    z-index: 1000; /* supaya di atas elemen lain */
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
      @yield('scripts')
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

  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function(){
    lucide.createIcons();
    });
  </script>

  <script>
     const input = document.getElementById('whatsapp');

  if (input) {
    input.addEventListener('input', function () {
      let value = input.value.replace(/\D/g, ''); // Hapus semua non-digit

      // Maksimal 15 digit
      value = value.slice(0, 15);

      // Normalisasi awalan
      if (value.startsWith('08')) {
        value = '+62' + value.slice(1); // buang 0, ganti dengan +62
      } else if (value.startsWith('62')) {
        value = '+62' + value.slice(2);
      } else if (!value.startsWith('+62')) {
        value = '+62' + value;
      }

      // Format ke +62 XXX-XXXX-XXXX atau sesuai panjang
      let formatted = value
        .replace(/^(\+62)(\d{3})(\d{4})(\d{0,4}).*/, function (_, p1, p2, p3, p4) {
          let result = p1 + " " + p2 + "-" + p3;
          if (p4) result += "-" + p4;
          return result;
        });

      input.value = formatted;
    });
  }
  </script>

  <script>
    const input = document.getElementById('password');
const toggle = document.getElementById('toggle-password');

toggle.addEventListener('click', () => {
  input.type = input.type === 'password' ? 'text' : 'password';
});
  </script>

<script>
document.getElementById('recipientEmail').addEventListener('keyup', function() {
    let query = this.value;
    let dropdown = document.getElementById('emailList');

    if (query.length > 2) { // minimal 3 huruf baru cari
        fetch(`/search-user?q=${query}`)
            .then(response => response.json())  
            .then(data => {
                dropdown.innerHTML = "";

                if (data.length > 0) {
                    dropdown.style.display = "block"; // tampilkan kalau ada hasil
                    data.forEach(user => {
                        let option = document.createElement("div");
                        option.classList.add("dropdown-item");
                        option.style.cursor = "pointer";
                        option.innerText = user.email;
                        option.onclick = function() {
                            document.getElementById('recipientEmail').value = user.email;
                            document.getElementById('recipientPhone').value = user.phone;
                            dropdown.innerHTML = "";
                            dropdown.style.display = "none"; // sembunyikan setelah pilih
                        };
                        dropdown.appendChild(option);
                    });
                } else {
                    dropdown.style.display = "none"; // sembunyikan kalau kosong
                }
            });
    } else {
        dropdown.innerHTML = "";
        dropdown.style.display = "none"; // sembunyikan kalau <3 huruf
    }
});

</script>


  <script src="{{ asset('front-end/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
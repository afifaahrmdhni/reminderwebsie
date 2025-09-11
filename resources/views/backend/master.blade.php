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
function addEmail() {
    let wrapper = document.getElementById("email-wrapper");
    let div = document.createElement("div");
    div.classList.add("position-relative", "mb-2");
    div.innerHTML = `
        <input type="text" class="form-control recipient_email" name="recipient_email[]" placeholder="contoh: a@gmail.com" autocomplete="off">
        <div class="list-group position-absolute w-100 emailSuggestions" style="z-index:1000;"></div>
    `;
    wrapper.appendChild(div);
    attachAutocomplete(div.querySelector(".recipient_email"), div.querySelector(".emailSuggestions"));
}

function addPhone() {
    let wrapper = document.getElementById("phone-wrapper");
    let input = document.createElement("input");
    input.type = "text";
    input.classList.add("form-control", "mb-2", "recipient_phone");
    input.name = "recipient_phone[]";
    input.placeholder = "contoh: 08123456789";
    wrapper.appendChild(input);
}

// === Autocomplete logic ===
function attachAutocomplete(emailInput, suggestionBox) {
    emailInput.addEventListener("keyup", function () {
        let query = this.value.trim();

        if (query.length >= 3) {
            fetch(`{{ url('/search-email') }}?q=${query}`)
                .then(res => res.json())
                .then(data => {
                    suggestionBox.innerHTML = "";
                    if (data.length > 0) {
                        data.forEach(user => {
                            let item = document.createElement("a");
                            item.href = "#";
                            item.classList.add("list-group-item", "list-group-item-action");
                            item.textContent = user.email;

                            item.addEventListener("click", function (e) {
                                e.preventDefault();
                                emailInput.value = user.email;

                                // Cari input phone pertama yang masih kosong, isi otomatis
                                let phoneInputs = document.querySelectorAll(".recipient_phone");
                                for (let phoneInput of phoneInputs) {
                                    if (!phoneInput.value) {
                                        phoneInput.value = user.phone || "";
                                        break;
                                    }
                                }

                                suggestionBox.innerHTML = "";
                            });

                            suggestionBox.appendChild(item);
                        });
                    }
                })
                .catch(err => console.error(err));
        } else {
            suggestionBox.innerHTML = "";
        }
    });
}

// attach autocomplete ke email pertama saat page load
document.addEventListener("DOMContentLoaded", function () {
    let firstEmail = document.querySelector(".recipient_email");
    let firstSuggestions = document.querySelector(".emailSuggestions");
    attachAutocomplete(firstEmail, firstSuggestions);
});
</script>

  <script src="{{ asset('front-end/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Reminder System</title>

  {{-- Bootstrap 5 CDN --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="{{asset('front-end/css/bootstrap.min.css')}}">

  {{-- Custom CSS --}}

  <style>
    body {
      background: #f8f9fa;
    }
    .login-card {
      max-width: 420px;
      margin: auto;
      margin-top: 8%;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      background: #fff;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <h2 class="text-center mb-3">Reminder System</h2>
    <p class="text-center text-muted mb-4">Login to your account</p>

    {{-- Alert error --}}
    @if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
      @csrf

      {{-- Email --}}
      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" required autofocus>
      </div>

      {{-- Password --}}
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      {{-- Remember Me --}}
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="remember" name="remember">
        <label class="form-check-label" for="remember">
          Remember Me
        </label>
      </div>

      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>

</body>
</html>

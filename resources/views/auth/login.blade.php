<!DOCTYPE html>
<html lang="id">
<head>
  <title>Login | Sistem Informasi Sekolah</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-light">
  <div class="auth-main">
    <div class="auth-wrapper v1">
      <div class="auth-form">
        <div class="card my-5">
          <div class="card-body">
            <div class="text-center mb-4">
              <h4 class="f-w-500">Login Administrator</h4>
              <p class="text-muted">Masukkan username dan password Anda</p>
            </div>

            <!-- Pesan Error Login -->
            @if(session('error'))
              <div class="alert alert-danger mb-3">
                {{ session('error') }}
              </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required autofocus>
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
              </div>
              <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

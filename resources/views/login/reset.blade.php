<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DOSIMAL - Reset Password</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->   
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

    <style>
        .login-page {
            background-size: cover;
            background-position: center;
        }
        .login-box {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 400px;
        }
        .btn-reset {
            background-color: #C84B31;
            border-color: #C84B31;
            color: white;
        }
        .btn-reset:hover {
            background-color: #A13821;
            border-color: #A13821;
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="text-center">
            <img src="/path/to/logo.png" alt="Logo" class="mb-4" style="width: 80px;">
            <h3 class="mb-0">DOSIMAL</h3>
            <p class="text-danger">JURUSAN TEKNOLOGI INFORMASI</p>
            <p class="text-muted">Reset Password</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="Email" required autocomplete="email" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-reset btn-block">
                        Kirim Link Reset Password
                    </button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 text-center">
                    <a href="{{ route('login') }}" class="text-danger">
                        Kembali ke Login
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
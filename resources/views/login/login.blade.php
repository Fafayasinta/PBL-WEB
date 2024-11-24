<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DOSIMAL - Login</title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <body class="hold-transition login-page" style="background: url('{{asset('assets/img/BGtest.jpg')}}') no-repeat center center fixed; background-size: cover;">
</body>
  <style>
    
    .login-page {
        background-image: url("{{ asset('assets/img/BGtest.jpg') }}") !important;
        background-repeat: no-repeat !important;
        background-size: cover !important;
        background-position: center !important;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }


    /* Style yang sudah ada tetap sama, tambahkan style berikut */
    .login-box {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 10px;
      padding: 40px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      width: 400px;
      max-width: 90%;
    }


    /* Style untuk form container */
    .form-container {
      width: 85%;
      /* Mengatur lebar form */
      margin: 0 auto;
      /* Membuat form berada di tengah */
    }

    /* Style untuk input group */
    .input-group {
      margin-bottom: 1.5rem;
      /* Memberikan jarak antar input */
    }

    .input-group .form-control {
      height: 45px;
      /* Menyesuaikan tinggi input */
    }

    .input-group-text {
      width: 45px;
      /* Menyesuaikan lebar icon container */
      justify-content: center;
    }

    /* Style untuk remember me checkbox */
    .remember-container {
      padding: 0 10px;
      margin-bottom: 1.5rem;
    }

    /* Style untuk button container */
    .button-container {
      width: 100%;
      padding: 0 10px;
      margin-bottom: 1.5rem;
    }

    .btn-login {
      height: 45px;
      /* Menyesuaikan tinggi button */
      font-size: 16px;
      font-weight: 500;
    }

    /* Style untuk forgot password link */
    .forgot-password-container {
      text-align: center;
      margin-top: 1rem;
    }
  </style>

  <!-- Di dalam body, ubah bagian form menjadi seperti ini -->
  <div class="login-box">
    <div class="text-center mb-5">
      <img src="/assets/img/logo-polinema.png" alt="Logo Polinema" class="mb-3" width="80">
      <div class="logo-text">
        <h2>DOSIMAL</h2>
        <p>JURUSAN TEKNOLOGI INFORMASI</p>
      </div>
      <p class="text-muted">Login To Your Account</p>
    </div>

    <div class="form-container">
      <form action="{{ url('/postlogin') }}" method="post">
        @csrf
        <div class="input-group">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="remember-container">
          <div class="icheck-primary">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember" class="remember-text">
              Remember me
            </label>
          </div>
        </div>

        <div class="button-container">
          <button type="submit" class="btn btn-login btn-block">LOGIN</button>
        </div>

        <div class="forgot-password-container">
          <a href="{{ route('password.request') }}" class="text-danger">Lupa Password?</a>
        </div>
      </form>
    </div>
  </div>

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  </body>

</html>
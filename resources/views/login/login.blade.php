<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DOSIMAL - Login</title>
  

  <!-- Google Font: Source Sans Pro --> 
  <link rel="stylesheet" 
  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> 
    <!-- Font Awesome --> 
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}"> 
    <!-- icheck bootstrap --> 
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> 
    <!-- SweetAlert2 --> 
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> 
    <!-- Theme style --> 
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}"> 
  <body class="hold-transition login-page">
  
  <style>  
    .login-page {
        background-image: url("{{ asset('adminlte/dist/img/bg_login.png') }}") !important;
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
      width: 100%;
      height: 100%;
      /* display: flex; */
      justify-content: center; /* Pusatkan secara horizontal */
      align-items: center; /* Pusatkan secara vertikal */
    }

    /* Style untuk input group */
    .input-group {
      margin-bottom: 1.5rem;
    }

    .input-group .form-control {
      height: 40px;
      width: 80%; /* Memenuhi lebar penuh */
      border-radius: 5px;
      border: 1px solid #ccc;
      padding: 10px 15px;
    }

    .input-group-text {
      width: 45px; /* Lebar ikon */
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
      background: #CF4111;
      color: #FFFFFF;
      border: none;
      padding: 10px 20px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 800;
      cursor: pointer;
      width: 100%; /* Memenuhi lebar penuh */
      margin-top: 15px;
    }

    .btn-login:hover {
      background: #b8350e;
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
      <img src="{{ asset('adminlte/dist/img/polinema.png') }}" alt="Logo Polinema" class="mb-3" width="80">
      <div class="logo-text">
        <h2>DOSIMAL</h2>
        <p>JURUSAN TEKNOLOGI INFORMASI</p>
      </div>
      <p class="text-muted">Login To Your Account</p>
    </div>

    <div class="form-container">
      <form action="{{ url('login') }}" method="POST" id="form-login">
        @csrf
        <div class="input-group">
          <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
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

        {{-- <div class="forgot-password-container">
          <a href="{{ route('password.request') }}" class="text-danger">Lupa Password?</a>
        </div>
        <div class="forgot-password-container">
          <a href="{{ url('register') }}" class="text-center">Belum punya akun ?</a>
        </div> --}}
      </form>
    </div>
  </div>

<!-- jQuery --> 
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script> 
<!-- Bootstrap 4 --> 
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 
<!-- jquery-validation --> 
<script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script> 
<script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script> 
<!-- SweetAlert2 --> 
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script> 
<!-- AdminLTE App --> 
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script> 

<script> 
  $.ajaxSetup({ 
    headers: { 
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
    } 
  }); 
 
  $(document).ready(function() { 
    $("#form-login").validate({ 
      rules: { 
        username: {required: true, minlength: 4, maxlength: 20}, 
        password: {required: true, minlength: 6, maxlength: 20} 
      }, 
      submitHandler: function(form) { // ketika valid, maka bagian yg akan dijalankan 
        $.ajax({ 
          url: form.action, 
          type: form.method, 
          data: $(form).serialize(), 
          success: function(response) { 
            if(response.status){ // jika sukses 
              Swal.fire({ 
                  icon: 'success', 
                  title: 'Berhasil', 
                  text: response.message, 
              }).then(function() { 
                  window.location = response.redirect; 
              }); 
            }else{ // jika error 
              $('.error-text').text(''); 
              $.each(response.msgField, function(prefix, val) { 
                  $('#error-'+prefix).text(val[0]); 
              }); 
              Swal.fire({ 
                  icon: 'error', 
                  title: 'Terjadi Kesalahan', 
                  text: response.message 
              }); 
            } 
          } 
        }); 
        return false; 
      }, 
      errorElement: 'span', 
      errorPlacement: function (error, element) { 
        error.addClass('invalid-feedback'); 
        element.closest('.input-group').append(error); 
      }, 
      highlight: function (element, errorClass, validClass) { 
        $(element).addClass('is-invalid'); 
      }, 
      unhighlight: function (element, errorClass, validClass) { 
        $(element).removeClass('is-invalid'); 
      } 
    }); 
  }); 
</script>  
</body>
</html>
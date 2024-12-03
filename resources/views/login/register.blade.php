<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Pengguna</title>
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
</head>

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

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        
        <div class="card card-outline card-primary">
            <div class="card-header text-center"><a href="{{ url('/') }}" class="h1"><b>Admin</b>LTE</a></div>
            <div class="card-body">
                <p class="login-box-msg">Sign up to start your session</p>
                <form action="{{ url('register') }}" method="POST" id="form-register">
                    @csrf
                    <div class="form-group">
                        <label>Level Pengguna</label>
                        <select name="level_id" id="level_id" class="form-control" required>
                            <option value="">- Pilih Level -</option>
                            @foreach ($level as $l)
                                <option value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-level_id" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input value="" type="text" name="username" id="username" class="form-control" required>
                        <small id="error-username" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input value="" type="text" name="nama" id="nama" class="form-control" required>
                        <small id="error-nama" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input value="" type="password" name="password" id="password" class="form-control" required>
                        <small id="error-password" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input value="" type="nip" name="nip" id="nip" class="form-control" required>
                        <small id="error-password" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input value="" type="email" name="email" id="email" class="form-control" required>
                        <small id="error-password" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <br>
                <div class="card-footer text-center">
                    <p class="mb-1">
                    <a href="{{ url('/login') }}">Sudah memiliki akun? Masuk disini</a>
                    </p>
            </div>
        </br>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

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
            $("#form-register").validate({
                rules: {
                    level_id: {
                    required: true,
                    number: true
                },
                username: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                nama: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                password: {
                    required: true,
                    minlength: 5,
                    maxlength: 20
                },
                nip: {
                    required: true,
                    minlength: 5,
                    maxlength: 20   
                },
                email: {
                    required: true,
                    minlength: 5,
                    maxlength: 50
                }
                },
                submitHandler: function(form) { // ketika valid, maka bagian yg akan dijalankan
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) { // jika sukses
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                }).then(function() {
                                    window.location = response.redirect;
                                });
                            } else { // jika error
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
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
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>

</html>
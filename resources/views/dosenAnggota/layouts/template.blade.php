<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Blank Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>

<style>
  .main-header .navbar-nav .nav-link {
      color: #808080 !important; /* Atau warna spesifik yang Anda inginkan */
  }

  .form-control-sidebar {
      background-color: white !important; /* Mengatur latar belakang kotak pencarian menjadi putih */
      color: black !important; /* Mengatur warna teks menjadi hitam agar kontras dengan latar belakang */
  }

  .btn-sidebar {
      background-color: white !important; /* Mengatur latar belakang tombol pencarian */
      color: #007bff !important; /* Mengatur warna teks tombol menjadi putih */
  }

  .btn-sidebar:hover {
      background-color: #0056b3 !important; /* Mengatur latar belakang tombol saat hover */
  }

  .sidebar {
      background-color: #001185; /* Warna biru */
      color: white; /* Mengubah warna teks menjadi putih */
      height: 100vh; /* Mengisi penuh tinggi viewport */
      display: flex;
      flex-direction: column;
      justify-content: space-between; /* Menyebar konten dan tombol logout */
  }
  
  /* Menambahkan warna untuk link di sidebar */
  .nav-link {
      color: white !important; /* Mengatur warna teks link menjadi putih */
  }

  /* Mengubah warna saat hover */
  .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.2); /* Warna latar belakang saat hover */
  }

  .logout-button-container {
      margin-top: auto; /* Memastikan tombol logout berada di bagian bawah */
      margin-bottom: 30px;
  }
</style>

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('dosenAnggota.layouts.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #001185; color: white">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link d-flex align-items-center">
      <img src="{{ asset('adminlte/dist/img/polinema.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="width: 40px; height: 60px; margin-right: 10px;">
      <div style="line-height: 1.15;">
        <span class="brand-text font-weight-bold" style="font-size: 20px; display: block;">DOSIMAL</span>
        <span class="brand-text font-weight-bold" style="font-size: 12px; display: block;">POLITEKNIK NEGERI MALANG</span>
      </div>
    </a>
    
    
    <br>

    <!-- Sidebar -->
    @include('dosenAnggota.layouts.sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('dosenAnggota.layouts.breadcrumb')

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('dosenAnggota.layouts.footer')
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>

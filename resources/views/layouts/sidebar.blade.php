<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Dashboard -->
    <li class="nav-item">
      <a href="{{ url('/') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }} ">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
      </a>
    </li>

    <!-- Profile -->
    <li class="nav-item">
      <a href="{{ url('/profile') }}" class="nav-link {{ $activeMenu == 'level' ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Profile</p>
      </a>
    </li>

    <!-- Kategori Kegiatan Dosen -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
          Kategori Kegiatan Dosen
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url('/level') }}" class="nav-link {{ $activeMenu == 'level' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Kelola Jenis Kegiatan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/level') }}" class="nav-link {{ $activeMenu == 'level' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Kelola Jabatan Kegiatan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/level') }}" class="nav-link {{ $activeMenu == 'level' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Kelola Kegiatan JTI</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/level') }}" class="nav-link {{ $activeMenu == 'level' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Kelola Kegiatan Non JTI</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- Kategori Pengguna -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Kategori Pengguna
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url('/level') }}" class="nav-link {{ $activeMenu == 'level' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Kelola Jenis Pengguna</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/level') }}" class="nav-link {{ $activeMenu == 'level' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Kelola Pengguna</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- Kategori Statistik Beban Kerja -->
    <li class="nav-item">
      <a href="{{ url('/level') }}" class="nav-link {{ $activeMenu == 'level' ? 'active' : '' }}">
        <i class="nav-icon fas fa-chart-bar"></i>
        <p>Statistik Beban Kerja</p>
      </a>
    </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->
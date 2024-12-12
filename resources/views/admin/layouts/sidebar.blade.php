<div class="sidebar">
  <!-- SidebarSearch Form -->
  <div class="form-inline mb-3">
    <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
            </button>
        </div>
    </div>
</div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ url('/admin') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>Dashboard</p>
              </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/profile') }}" class="nav-link {{ ($activeMenu == 'profile')? 'active' : '' }}">
                  <i class="nav-icon fas fa-address-card"></i>
                  <p>Profile</p>
              </a>
          </li>
          <!-- DROPDOWN -->
          <li class="nav-header">KEGIATAN</li>
          <li class="nav-item {{ in_array($activeMenu, ['jeniskegiatan', 'jabatankegiatan', 'kegiatanjti', 'kegiatannonjti', 'periode', 'agenda']) ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ in_array($activeMenu, ['jeniskegiatan', 'jabatankegiatan', 'kegiatanjti', 'kegiatannonjti', 'periode', 'agenda']) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>Kegiatan Dosen<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('/jeniskegiatan') }}" class="nav-link {{ $activeMenu == 'jeniskegiatan' ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Jenis Kegiatan</p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/jabatankegiatan') }}" class="nav-link {{ ($activeMenu == 'jabatankegiatan')? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Jabatan Kegiatan</p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/kegiatanjti') }}" class="nav-link {{ ($activeMenu == 'kegiatanjti')? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Kegiatan JTI</p>
                      </a>
                  </li>
                  {{-- <li class="nav-item">
                    <a href="{{ url('/agenda') }}" class="nav-link {{ ($activeMenu == 'agenda')? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Agenda Kegiatan</p>
                      </a>
                  </li> --}}
                  <li class="nav-item">
                    <a href="{{ url('/periode') }}" class="nav-link {{ ($activeMenu == 'periode')? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Periode Kegiatan</p>
                      </a>
                  </li>
                  @if(auth()->user()->level->level_kode == 'ADMIN')
                  <li class="nav-item">
                    <a href="{{ url('/kegiatannonjti') }}" class="nav-link {{ ($activeMenu == 'kegiatannonjti')? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Kegiatan Non JTI</p>
                      </a>
                  </li>
                  @if(auth()->user()->level->level_kode == 'ADMIN')
                  <li class="nav-item">
                    <a href="{{ url('/periode') }}" class="nav-link {{ ($activeMenu == 'periode')? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Periode Kegiatan</p>
                      </a>
                  </li>
                  @endif
              </ul>
          </li>
          <li class="nav-header">PENGGUNA</li>
          <li class="nav-item {{ in_array($activeMenu, ['jenispengguna', 'pengguna']) ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ in_array($activeMenu, ['jenispengguna', 'pengguna']) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Pengguna<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ url('/jenispengguna') }}" class="nav-link {{ $activeMenu == 'jenispengguna' ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Jenis Pengguna</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('/pengguna')  }}" class="nav-link {{ $activeMenu == 'pengguna' ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Pengguna</p>
                      </a>
                  </li>
              </ul>
          </li>
          <li class="nav-item">
              <a href="{{ url('/statistik') }}" class="nav-link {{ $activeMenu == 'statistik' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>Statistik Beban Kerja</p>
              </a>
          </li>
      </ul>
  </nav>
  
  <!-- Tombol Logout -->
  <div class="logout-button-container mt-auto">
      <a href="{{ url('/logout') }}" class="logout-button btn btn-danger btn-block" style="color: white">
          <i class="nav-icon fas fa-sign-out-alt" style="margin-right: 5px"></i> Logout
      </a>
  </div>
</div>
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
            <a href="{{ url('/dosen') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }}">
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
          <li class="nav-header">KEGIATAN</li>
          <li class="nav-item {{ in_array($activeMenu, ['kegiatanjti', 'kegiatannonjti']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ in_array($activeMenu, ['kegiatanjti', 'kegiatannonjti']) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>Kegiatan Dosen<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ url('/kegiatandosenjti') }}" class="nav-link {{ ($activeMenu == 'kegiatanjti')? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kegiatan JTI</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('/kegiatandosennonjti') }}" class="nav-link {{ ($activeMenu == 'kegiatannonjti')? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kegiatan Non JTI</p>
                      </a>
                  </li>
              </ul>
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

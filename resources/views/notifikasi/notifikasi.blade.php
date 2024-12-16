<!-- Navbar atau Icon Notifikasi -->
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
      Notifikasi
      <span class="badge bg-danger">{{ $notifikasi->count() }}</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="right: 0; left: auto; width: 300px; max-height: 400px; overflow-y: auto;">
      <li class="dropdown-header">Notifikasi Terbaru</li>
      @forelse($notifikasi as $notification)
          <li>
              <a class="dropdown-item" href="#">
                  <strong>{{ $notification->judul }}</strong><br>
                  <small class="text-muted">{{ $notification->deskripsi }}</small><br>
                  <small class="text-muted">{{ $notification->created_at}}</small>
              </a>
          </li>
          <li><hr class="dropdown-divider"></li>
      @empty
          <li class="dropdown-item text-center">Tidak ada notifikasi</li>
      @endforelse
  </ul>
  <script>
    // Ambil tombol dropdown dan menu notifikasi
    const dropdownToggle = document.getElementById('dropdownMenuButton');
    const dropdownMenu = document.querySelector('.dropdown-menu');
  
    // Fungsi untuk membuka/tutup dropdown
    dropdownToggle.addEventListener('click', function (e) {
      e.stopPropagation(); // Mencegah event bubbling
      dropdownMenu.classList.toggle('show');
    });
  
    // Menutup dropdown ketika klik di luar dropdown
    document.addEventListener('click', function (e) {
      if (!dropdownMenu.contains(e.target) && !dropdownToggle.contains(e.target)) {
        dropdownMenu.classList.remove('show');
      }
    });
  </script>
  
</div>

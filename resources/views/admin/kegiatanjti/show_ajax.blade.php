<style>
    .custom-blue-header {
        background-color: #007bff; /* Warna biru */
        color: white; /* Warna teks putih agar kontras */
    }
</style>

@if(!$kegiatanjti->isEmpty())
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Detail Kegiatan JTI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong>Data Kegiatan</strong><br>
                    Berikut adalah Detail dari data jabatan kegiatan.
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th class="text-left">Nama Kegiatan</th>
                        <td>{{ $kegiatanjti->first()->kegiatan->nama_kegiatan }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Deskripsi</th>
                        <td>{{ $kegiatanjti->first()->kegiatan->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Jenis Kegiatan</th>
                        <td>{{ $kegiatanjti->first()->kegiatan->kategori->nama_kategori }}</td>
                    </tr>
                </table>
                <br>
                <div class="alert alert-info">
                    <strong>Data Anggota Kegiatan</strong><br>
                    Berikut adalah list nama anggota kegiatan.
                </div>
                <table class="table-bordered table-striped table-hover table-sm table" id="table_anggota" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">NAMA DOSEN</th>
                            <th class="text-center">JABATAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatanjti as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                                <td>{{ $item->user->nama }}</td> <!-- Menampilkan nama dosen -->
                                <td>{{ $item->jabatan }}</td> <!-- Menampilkan jabatan -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Kembali</button>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <div class="text-right">
                    <a href="{{ url('/kegiatanjti') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endif
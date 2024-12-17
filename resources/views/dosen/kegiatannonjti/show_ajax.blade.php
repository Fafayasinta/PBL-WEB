@empty($kegiatannonjti)
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
                    <a href="{{ url('/kegiatannonjti') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Detail Kegiatan Non JTI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong>Data Kegiatan Non JTI</strong><br>
                    Berikut adalah Detail dari data kegiatan non JTI.
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th class="text-left" style="width: 27%">NO</th>
                        <td>{{ $kegiatannonjti->kegiatan_id }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">NAMA KEGIATAN</th>
                        <td>{{ $kegiatannonjti->nama_kegiatan }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">DESKRIPSI KEGIATAN</th>
                        <td>{{ $kegiatannonjti->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">NAMA DOSEN</th>
                        <td>{{ $kegiatannonjti->user->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">WILAYAH KERJA</th>
                        <td>{{ $kegiatannonjti->cakupan_wilayah }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">JENIS</th>
                        <td>{{ $kegiatannonjti->kategori->nama_kategori }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">WAKTU</th>
                        <td>{{ \Carbon\Carbon::parse($kegiatannonjti->waktu_mulai)->translatedFormat('d F Y') }}</td>
                    </tr>                    
                    <tr>
                        <th class="text-left">BEBAN</th>
                        <td>{{ $kegiatannonjti->beban->nama_beban }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                @if ($kegiatannonjti->surat_tugas) 
                    <a href="{{ asset($kegiatannonjti->surat_tugas) }}" target="_blank" class="btn btn-info">Lihat Surat Tugas</a>
                @endif
                <button type="button" data-dismiss="modal" class="btn btn-warning">Kembali</button>
            </div>
        </div>
    </div>
@endempty
@empty($jeniskegiatan)
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
                    <a href="{{ url('/jeniskegiatan') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Detail Jenis Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong>Data Jenis Kegiatan</strong><br>
                    Berikut adalah Detail dari data jenis kegiatan.
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th class="text-left" style="width: 27%">No</th>
                        <td>{{ $jeniskegiatan->kategori_kegiatan_id }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Nama</th>
                        <td>{{ $jeniskegiatan->nama_kategori }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Deskripsi</th>
                        <td>{{ $jeniskegiatan->deskripsi }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Kembali</button>
            </div>
        </div>
    </div>
@endempty
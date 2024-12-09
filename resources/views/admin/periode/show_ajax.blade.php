<style>
    .custom-blue-header {
        background-color: #007bff; /* Warna biru */
        color: white; /* Warna teks putih agar kontras */
    }
</style>

@empty($periode)
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
                    <a href="{{ url('/periode') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Detail Periode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong>Data Periode Kegiatan</strong><br>
                    Berikut adalah detail dari data periode kegiatan.
                </div>
                <table class="table table-bordered table-striped">
                    <thead class="custom-blue-header">
                        <tr>
                            <th>NO</th>
                            <th>NAMA KEGIATAN</th>
                            <th>JENIS</th>
                            <th>PENANGGUNG JAWAB</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($periode as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama_kegiatan }}</td>
                                <td>{{ $item->kategori->nama_kategori }}</td>
                                <td>{{ $item->user->nama }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada kegiatan untuk tahun ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Kembali</button>
            </div>
        </div>
    </div>
@endempty

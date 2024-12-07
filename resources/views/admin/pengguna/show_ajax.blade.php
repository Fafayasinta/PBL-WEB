@empty($pengguna)
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
                    <a href="{{ url('/pengguna') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong>Data Pengguna</strong><br>
                    Berikut adalah Detail dari data pengguna.
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th class="text-left" style="width: 27%">No</th>
                        <td>{{ $pengguna->user_id }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Level</th>
                        <td>{{ $pengguna->level->level_nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Username</th>
                        <td>{{ $pengguna->username }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Password</th>
                        <td>{{ $pengguna->password }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Nama</th>
                        <td>{{ $pengguna->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">NIP</th>
                        <td>{{ $pengguna->nip }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Email</th>
                        <td>{{ $pengguna->email }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Kembali</button>
            </div>
        </div>
    </div>
@endempty

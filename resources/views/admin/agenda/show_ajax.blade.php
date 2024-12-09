@empty($agenda)
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
                    <a href="{{ url('/agenda') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Detail Agenda Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong>Data Agenda Kegiatan</strong><br>
                    Berikut adalah Detail dari data agenda kegiatan.
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th class="text-left" style="width: 27%">No</th>
                        <td>{{ $agenda->agenda_id }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">NAMA KEGIATAN</th>
                        <td>{{ $agenda->kegiatan->nama_kegiatan }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">NAMA AGENDA</th>
                        <td>{{ $agenda->nama_agenda }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">PENANGGUNG JAWAB</th>
                        <td>{{ $agenda->user->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">DEADLINE</th>
                        <td>{{ \Carbon\Carbon::parse($agenda->deadline)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">LOKASI</th>
                        <td>{{ $agenda->lokasi }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">PROGRES</th>
                        <td>{{ $agenda->progres }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">KETERANGAN</th>
                        <td>{{ $agenda->keterangan }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Kembali</button>
            </div>
        </div>
    </div>
@endempty
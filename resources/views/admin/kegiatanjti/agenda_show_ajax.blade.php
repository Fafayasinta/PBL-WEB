@empty($agendakegiatanjti)
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
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Detail agendakegiatanjti Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong>Data agendakegiatanjti Kegiatan</strong><br>
                    Berikut adalah Detail dari data agendakegiatanjti kegiatan.
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th class="text-left" style="width: 27%">No</th>
                        <td>{{ $agendakegiatanjti->agendakegiatanjti_id }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">NAMA KEGIATAN</th>
                        <td>{{ $agendakegiatanjti->kegiatan->nama_kegiatan }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">NAMA agendakegiatanjti</th>
                        <td>{{ $agendakegiatanjti->nama_agendakegiatanjti }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">PENANGGUNG JAWAB</th>
                        <td>{{ $agendakegiatanjti->user->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">DEADLINE</th>
                        <td>{{ \Carbon\Carbon::parse($agendakegiatanjti->deadline)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">LOKASI</th>
                        <td>{{ $agendakegiatanjti->lokasi }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">PROGRES</th>
                        <td>{{ $agendakegiatanjti->progres }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">KETERANGAN</th>
                        <td>{{ $agendakegiatanjti->keterangan }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Kembali</button>
            </div>
        </div>
    </div>
@endempty
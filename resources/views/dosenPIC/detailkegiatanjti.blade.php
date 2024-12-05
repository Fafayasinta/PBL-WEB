<!-- detail_kegiatan_jti.blade.php -->
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Detail Kegiatan JTI</h4>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Nama Kegiatan</th>
                        <td>{{ $kegiatan->nama_kegiatan }}</td>
                    </tr>
                    <tr>
                        <th>PIC</th>
                        <td>{{ $kegiatan->pic }}</td>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <td>{{ $kegiatan->waktu_mulai }} - {{ $kegiatan->waktu_selesai }}</td>
                    </tr>
                    <tr>
                        <th>Progress</th>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ $kegiatan->progres }}%">
                                    {{ $kegiatan->progres }}%
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Daftar Anggota -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h5>Anggota Kegiatan</h5>
                @if(Auth::user()->role == 'PIC' && Auth::user()->id == $kegiatan->user_id)
                <button class="btn btn-primary btn-sm" onclick="tambahAnggota()">
                    Tambah Anggota
                </button>
                @endif
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Posisi</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anggota as $a)
                        <tr>
                            <td>{{ $a->nama }}</td>
                            <td>{{ $a->posisi }}</td>
                            <td>{{ $a->bobot }}</td>
                            <td>
                                @if(Auth::user()->role == 'PIC' && Auth::user()->id == $kegiatan->user_id)
                                <button class="btn btn-danger btn-sm">Hapus</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Agenda Kegiatan -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Agenda Kegiatan</h5>
                @if(Auth::user()->role == 'PIC' && Auth::user()->id == $kegiatan->user_id)
                <button class="btn btn-primary btn-sm" onclick="tambahAgenda()">
                    Tambah Agenda
                </button>
                @endif
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Agenda</th>
                            <th>Waktu</th>
                            <th>Tempat</th>
                            <th>Progress</th>
                            <th>PIC</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agendas as $agenda)
                        <tr>
                            <td>{{ $agenda->nama_agenda }}</td>
                            <td>{{ $agenda->waktu }}</td>
                            <td>{{ $agenda->tempat }}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $agenda->progress }}%">
                                        {{ $agenda->progress }}%
                                    </div>
                                </div>
                            </td>
                            <td>{{ $agenda->pic }}</td>
                            <td>
                                @if($agenda->bukti)
                                <button class="btn btn-info btn-sm" onclick="lihatBukti('{{ $agenda->bukti }}')">
                                    Lihat
                                </button>
                                @else
                                @if(Auth::id() == $agenda->user_id)
                                <button class="btn btn-primary btn-sm" onclick="uploadBukti({{ $agenda->id }})">
                                    Upload
                                </button>
                                @else
                                -
                                @endif
                                @endif
                            </td>
                            <td>
                                @if(Auth::user()->role == 'PIC' && Auth::user()->id == $kegiatan->user_id)
                                <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm">Hapus</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Upload Bukti -->
<div class="modal fade" id="modalUpload">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Bukti Kegiatan</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formUpload" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>File Bukti</label>
                        <input type="file" name="bukti" class="form-control" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
function uploadBukti(agendaId) {
    $('#modalUpload').modal('show');
    $('#formUpload').attr('action', `/agenda/${agendaId}/upload-bukti`);
}

function lihatBukti(url) {
    window.open(url, '_blank');
}

@if(Auth::user()->role == 'PIC' && Auth::user()->id == $kegiatan->user_id)
function tambahAnggota() {
    const modalHtml = `
        <div class="modal fade" id="modalAnggota">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Tambah Anggota</h5>
                        <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form id="formAnggota">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Pilih Dosen</label>
                                <select name="user_id" class="form-control select2" required>
                                    <option value="">Pilih Dosen</option>
                                    @foreach($dosens as $d)
                                    <option value="{{ $d->user_id }}">{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Jabatan</label>
                                <select name="jabatan" class="form-control" required>
                                    <option value="">Pilih Jabatan</option>
                                    <option value="PIC">PIC</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Bendahara">Bendahara</option>
                                    <option value="Anggota">Anggota</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    `;

    // Tambahkan modal ke body
    $('body').append(modalHtml);
    
    // Initialize select2
    $('.select2').select2({
        dropdownParent: $('#modalAnggota')
    });

    // Show modal
    $('#modalAnggota').modal('show');

    // Handle form submit
    $('#formAnggota').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: `/kegiatan/${kegiatanId}/anggota`,
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if(response.success) {
                    toastr.success('Anggota berhasil ditambahkan');
                    $('#modalAnggota').modal('hide');
                    location.reload();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr) {
                toastr.error('Terjadi kesalahan saat menambah anggota');
            }
        });
    });

    // Clean up modal when closed
    $('#modalAnggota').on('hidden.bs.modal', function() {
        $(this).remove();
    });
}

function tambahAgenda() {
    // Logic tambah agenda  
}
@endif
</script>
@endpush
@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Kegiatan</h3>
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahModal">
                        Tambah Kegiatan
                    </button>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th width="200">Nama Kegiatan</th>
                                    <td>: {{ $kegiatan->nama_kegiatan }}</td>
                                </tr>
                                <tr>
                                    <th>PIC</th>
                                    <td>: {{ $kegiatan->pic }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kegiatan</th>
                                    <td>: {{ $kegiatan->kategori->nama_kategori }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>: 
                                        @if($kegiatan->status == 'Proses')
                                            <span class="badge badge-warning">Proses</span>
                                        @elseif($kegiatan->status == 'Selesai')
                                            <span class="badge badge-success">Selesai</span>
                                        @else
                                            <span class="badge badge-danger">Belum Proses</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Beban Kerja</th>
                                    <td>: {{ $kegiatan->beban_kegiatan_id == 1 ? 'Berat' : ($kegiatan->beban_kegiatan_id == 2 ? 'Sedang' : 'Ringan') }}</td>
                                </tr>
                                <tr>
                                    <th>Waktu Mulai</th>
                                    <td>: {{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Waktu Selesai</th>
                                    <td>: {{ \Carbon\Carbon::parse($kegiatan->waktu_selesai)->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Deadline</th>
                                    <td>: {{ \Carbon\Carbon::parse($kegiatan->deadline)->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>: {{ $kegiatan->deskripsi }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Anggota Kegiatan</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Skor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($kegiatan->anggota as $anggota)
                                            <tr>
                                                <td>{{ $anggota->user->nama }}</td>
                                                <td>{{ $anggota->jabatan }}</td>
                                                <td>{{ $anggota->skor }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('kegiatan.edit', $kegiatan->kegiatan_id) }}" class="btn btn-warning">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formTambah">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Kegiatan</label>
                                <input type="text" class="form-control" name="nama_kegiatan" required>
                            </div>

                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control" name="kategori_kegiatan_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->kategori_kegiatan_id }}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Dosen PIC</label>
                                <select class="form-control" name="pic_id" required>
                                    <option value="">Pilih Dosen PIC</option>
                                    @foreach($dosens as $dosen)
                                        <option value="{{ $dosen->user_id }}">{{ $dosen->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Dosen Anggota</label>
                                <select class="form-control select2" name="anggota_ids[]" multiple="multiple" required>
                                    @foreach($dosens as $dosen)
                                        <option value="{{ $dosen->user_id }}">{{ $dosen->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Waktu Mulai</label>
                                <input type="date" class="form-control" name="waktu_mulai" required>
                            </div>

                            <div class="form-group">
                                <label>Waktu Selesai</label>
                                <input type="date" class="form-control" name="waktu_selesai" required>
                            </div>

                            <div class="form-group">
                                <label>Deadline</label>
                                <input type="date" class="form-control" name="deadline" required>
                            </div>

                            <div class="form-group">
                                <label>Beban Kerja</label>
                                <select class="form-control" name="beban_kegiatan_id" required>
                                    <option value="">Pilih Beban Kerja</option>
                                    @foreach($bebanKerja as $b)
                                        <option value="{{ $b->beban_kegiatan_id }}">{{ $b->nama_beban }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="4" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    // Inisialisasi Select2 untuk multiple select
    $('.select2').select2({
        placeholder: "Pilih Dosen Anggota",
        allowClear: true,
        width: '100%'
    });

    // Handler saat PIC dipilih
    $('select[name="pic_id"]').on('change', function() {
        var picId = $(this).val();
        // Disable option yang sudah dipilih sebagai PIC di select anggota
        $('select[name="anggota_ids[]"] option').prop('disabled', false);
        if(picId) {
            $('select[name="anggota_ids[]"] option[value="' + picId + '"]').prop('disabled', true);
        }
        $('.select2').select2('destroy').select2();
    });

    // Handler form submit
    $('#formTambah').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '{{ route("kegiatan.store") }}',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.success) {
                    $('#tambahModal').modal('hide');
                    alert('Data berhasil ditambahkan');
                    location.reload();
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan: ' + xhr.responseJSON.message);
            }
        });
    });
});
</script>
@endpush
@endsection
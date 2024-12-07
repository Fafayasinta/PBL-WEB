@extends('pimpinan.layouts.template')

@section('content')
    <div class="container-fluid mt-4">
        <!-- Detail Kegiatan -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h4 class="mb-0">Detail Kegiatan</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <table class="table table-borderless">
                            <tr>
                                <th>Tanggal Kegiatan</th>
                                <td>{{ $kegiatan->tanggal_kegiatan }}</td>
                            </tr>
                            <tr>
                                <th>Progress</th>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-success" style="width: {{ $kegiatan->progress }}%;">{{ $kegiatan->progress }}%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Keterangan Progress</th>
                                <td>{{ $kegiatan->keterangan_progress }}</td>
                            </tr>
                            <tr>
                                <th>Nama Ketua Pelaksana</th>
                                <td>{{ $kegiatan->ketua_pelaksana }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-8 text-end">
                        <button class="btn btn-warning me-2">Cetak Draft Surat</button>
                        <button class="btn btn-info me-2">Upload Surat</button>
                        <button class="btn btn-success">Lihat Surat</button>
                        <button class="btn btn-primary ms-2">Tambah</button>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anggota</th>
                            <th>Posisi</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggotaKegiatan as $index => $anggota)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $anggota->nama_anggota }}</td>
                                <td>{{ $anggota->posisi }}</td>
                                <td>{{ $anggota->bobot }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info">Detail</button>
                                    <button class="btn btn-sm btn-warning">Edit</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Agenda -->
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h4 class="mb-0">Agenda</h4>
                <button class="btn btn-primary">Tambah</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Agenda</th>
                            <th>Waktu</th>
                            <th>Tempat</th>
                            <th>Keterangan</th>
                            <th>Penanggung Jawab</th>
                            <th>Progress</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agendaKegiatan as $index => $agenda)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $agenda->nama_agenda }}</td>
                                <td>{{ $agenda->waktu }}</td>
                                <td>{{ $agenda->tempat }}</td>
                                <td>{{ $agenda->keterangan }}</td>
                                <td>{{ $agenda->penanggung_jawab }}</td>
                                <td>
                                    <span class="badge bg-{{ $agenda->progress === 'Selesai' ? 'success' : 'danger' }}">
                                        {{ $agenda->progress }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info">Detail</button>
                                    <button class="btn btn-sm btn-warning">Edit</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

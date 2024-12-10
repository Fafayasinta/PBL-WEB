@extends('admin.layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header" style="padding: 10px 15px;">
            <br>
            <h1 class="card-title" style="font-weight: bold; font-size: 20px; margin-left:10px">Detail Kegiatan</h1><br><br>
            <div style="display: flex; justify-content: center; align-items: center;">
                <table class="table table-bordered align-center" style="width: 95%">
                    <tr>
                        <th class="text-left" style="width: 35%">Tanggal Kegiatan</th>
                        <td style="font-weight: bold">{{ \Carbon\Carbon::parse($kegiatanjti->waktu_mulai)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Nama Ketua Pelaksanaan</th>
                        <td style="font-weight: bold">{{ $kegiatanjti->user->nama }}</td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/create_ajaxAnggota') }}')" class="btn btn-success" style="font-size: 16px; background-color: #ffe14c; color: white; border: none; border-radius: 15px; padding: 8px 30px; margin-right: 15px">Cetak Draft Surat</button>
                <button onclick="modalAction('{{ url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/create_ajaxAnggota') }}')" class="btn btn-success" style="font-size: 16px; background-color: #fa8072; color: white; border: none; border-radius: 15px; padding: 8px 30px; margin-right: 15px">Upload Surat</button>
                <button onclick="modalAction('{{ url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/create_ajaxAnggota') }}')" class="btn btn-success" style="font-size: 16px; background-color: #50c878; color: white; border: none; border-radius: 15px; padding: 8px 30px; margin-right: 15px">Lihat Surat</button>
                <button onclick="modalAction('{{ url('/anggota/create_ajax') }}')" class="btn btn-success" style="font-size: 16px; background-color: #17A2B8; color: white; border: none; border-radius: 15px; padding: 8px 30px; margin-right: 15px">Tambah</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    {{-- Filter jika diperlukan, bisa disesuaikan --}}
                </div>
            </div><br>
            <table class="table-bordered table-striped table-hover table-sm table" id="table_anggotakegiatanjti" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%">NO</th>
                        <th class="text-center" style="width: 40%">NAMA ANGGOTA</th>
                        <th class="text-center" style="width: 15%">POSISI</th>
                        <th class="text-center" style="width: 15%">BOBOT</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <br>
    <div class="card card-outline card-primary">
        <div class="card-header" style="padding: 10px 15px;">
            <br>
            <h1 class="card-title" style="font-weight: bold; font-size: 20px; margin-left:10px">Agenda Kegiatan</h1>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/agenda/create_ajax') }}')" class="btn btn-success" style="font-size: 16px; background-color: #17A2B8; color: white; border: none; border-radius: 15px; padding: 8px 30px; margin-right: 15px">Tambah</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    {{-- Filter jika diperlukan, bisa disesuaikan --}}
                </div>
            </div><br>
            <table class="table-bordered table-striped table-hover table-sm table" id="table_agendakegiatanjti" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">NAMA AGENDA</th>
                        <th class="text-center">WAKTU</th>
                        <th class="text-center">TEMPAT</th>
                        <th class="text-center" style="width: 15%">KETERANGAN</th>
                        <th class="text-center" style="width: 17%">PENANGGUNG JAWAB</th>
                        <th class="text-center">PROGRES</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
    {{-- <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .content-wrapper {
            height: 100%;
        }
    </style> --}}
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            })
        }

        var dataAnggotaKegiatanJti;
        $(document).ready(function() {
            // Ambil ID kegiatan dari variabel yang dikirim dari controller
            var kegiatanId = "{{ $kegiatanjti->id }}"; 

            dataAnggotaKegiatanJti = $('#table_anggotakegiatanjti').DataTable({
                serverSide: true, // Menggunakan server-side processing
                ajax: {
                    "url": "{{ url('kegiatanjti/' . $kegiatanjti->kegiatan_id . '/listAnggota') }}", 
                    "dataType": "json",
                    "type": "POST",
                    // Kirim data tambahan jika diperlukan
                },
                columns: [{
                        data: "DT_RowIndex", // Menampilkan nomor urut
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "user.nama", // Menampilkan nama anggota
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "jabatan", // Menampilkan jabatan anggota
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "skor", // Menampilkan skor anggota
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "action", // Menampilkan kolom aksi (Edit, Hapus)
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });

        var dataAgendaKegiatanJti;
        $(document).ready(function() {
            // Ambil ID kegiatan dari variabel yang dikirim dari controller
            var kegiatanId = "{{ $kegiatanjti->id }}"; 

            dataAgendaKegiatanJti = $('#table_agendakegiatanjti').DataTable({
                serverSide: true, // Menggunakan server-side processing
                ajax: {
                    "url": "{{ url('kegiatanjti/' . $kegiatanjti->kegiatan_id . '/listAgenda') }}", 
                    "dataType": "json",
                    "type": "POST",
                    // Kirim data tambahan jika diperlukan
                },
                columns: [{
                        data: "DT_RowIndex", // Menampilkan nomor urut
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama_agenda", // Menampilkan nama anggota
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "deadline",
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            if (data) {
                                let date = new Date(data);
                                return date.toLocaleDateString("id-ID", {
                                    day: "2-digit",
                                    month: "long",
                                    year: "numeric"
                                });
                            }
                            return "-";
                        }
                    },
                    {
                        data: "lokasi", // Menampilkan skor anggota
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "keterangan", // Menampilkan skor anggota
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "user.nama", // Menampilkan skor anggota
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "progres",
                        orderable: true,
                        searchable: false,
                        render: function (data, type, row) {
                            let color;
                            let label;

                            if (data < 1.00) {
                                color = '#f87171'; // Merah
                                label = 'Belum Selesai';
                            } else {
                                color = '#10b981'; // Hijau
                                label = 'Selesai';
                            }

                            return `
                                <div style="background-color: ${color}; color: white; padding: 5px; border-radius: 20px; text-align: center; width: 120px;">
                                    ${label}
                                </div>`;
                        },
                    },
                    {
                        data: "action", // Menampilkan kolom aksi (Edit, Hapus)
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush

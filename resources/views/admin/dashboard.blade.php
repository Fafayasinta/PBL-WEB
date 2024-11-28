<!-- resources/views/dashboard.blade.php -->
@extends('admin.layouts.template')

@section('content')
<div class="card" style="border: 1px solid #ddd; padding: 20px; border-radius: 10px; background-color: #f9f9f9;">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="row">
        <!-- Stat Panels -->
        <div class="col-md-3">
            <div class="card text-center" style="border-radius: 10px; border: 1px solid #ddd;">
                <div class="card-body">
                    <h6>Total Kegiatan Selesai</h6>
                    <div class="d-flex justify-content-center align-items-center">
                        <div style="background-color: #bbb9ff; padding: 10px; display: inline-block; border-radius: 10px;">
                            <i class="nav-icon fas fa-users"></i>    
                        </div>
                        <h2 style="margin-left: 20px">{{ $totalKegiatanSelesai }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="border-radius: 10px; border: 1px solid #ddd;">
                <div class="card-body">
                    <h6>Total Kegiatan Dalam Proses</h6>
                    <div class="d-flex justify-content-center align-items-center">
                        <div style="background-color: #ffd572; padding: 10px; display: inline-block; border-radius: 10px;">
                            <i class="nav-icon fas fa-box"></i>    
                        </div>
                        <h2 style="margin-left: 20px">{{ $totalKegiatanSelesai }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="border-radius: 10px; border: 1px solid #ddd;">
                <div class="card-body">
                    <h6>Total Kegiatan Belum Mulai</h6>
                    <div class="d-flex justify-content-center align-items-center">
                        <div style="background-color: #6af3ae; padding: 10px; display: inline-block; border-radius: 10px;">
                            <i class="nav-icon fas fa-chart-bar"></i>    
                        </div>
                        <h2 style="margin-left: 20px">{{ $totalKegiatanSelesai }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="border-radius: 10px; border: 1px solid #ddd;">
                <div class="card-body">
                    <h6>Total Kegiatan Ditunda</h6>
                    <div class="d-flex justify-content-center align-items-center">
                        <div style="background-color: #ffb398; padding: 10px; display: inline-block; border-radius: 10px;">
                            <i class="nav-icon fas fa-clock"></i>    
                        </div>
                        <h2 style="margin-left: 20px">{{ $totalKegiatanSelesai }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table of Activities -->
    <div class="card mt-4" style="border-radius: 10px; border: 1px solid #ddd;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Kegiatan Jurusan Teknologi Informasi</h4>
            <div class="filter-container ml-auto" style="margin-right: 10px;">
                <select class="form-control" name="filter" style="font-size: 14px; width: auto; border-radius: 10px" required>
                    <option value="01" {{ request('month') == '01' ? 'selected' : '' }}>januari</option>
                    <option value="02" {{ request('month') == '02' ? 'selected' : '' }}>februari</option>
                    <option value="03" {{ request('month') == '03' ? 'selected' : '' }}>maret</option>
                    <option value="04" {{ request('month') == '04' ? 'selected' : '' }}>april</option>
                    <option value="05" {{ request('month') == '05' ? 'selected' : '' }}>mei</option>
                    <option value="06" {{ request('month') == '06' ? 'selected' : '' }}>juni</option>
                    <option value="07" {{ request('month') == '07' ? 'selected' : '' }}>juli</option>
                    <option value="08" {{ request('month') == '08' ? 'selected' : '' }}>agustus</option>
                    <option value="09" {{ request('month') == '09' ? 'selected' : '' }}>september</option>
                    <option value="10" {{ request('month') == '10' ? 'selected' : '' }}>oktober</option>
                    <option value="11" {{ request('month') == '11' ? 'selected' : '' }}>november</option>
                    <option value="12" {{ request('month') == '12' ? 'selected' : '' }}>desember</option>
                </select>
            </div>
        </div>             
        <div class="card-body">
            <table class="table-bordered table-striped table-hover table-sm table" id="table_admin" style="width: 100%">
                <thead>
                    <tr>
                        <th>Nama Kegiatan</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Akhir</th>
                        <th>PIC</th>
                        <th>Progres</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            })
        }
        var dataAdmin;
        $(document).ready(function() {
            dataAdmin = $('#table_admin').DataTable({
                serverSide: true, // Menggunakan server-side processing
                ajax: {
                    "url": "{{ url('admin/list') }}", // Endpoint untuk mengambil data kategori
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.nama_kegiatan = $('#nama_kegiatan').val(); // Mengirim data filter kategori_kode
                    }
                },
                columns: [
                    {
                        data: "nama_kegiatan",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "waktu_mulai",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "waktu_selesai",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "pic",
                        orderable: true,
                        searchable: true
                    },
                    {
                data: "progres",
                orderable: true,
                searchable: true,
                render: function(data, type, row) {
                    // Konversi nilai decimal ke persen
                    const percentage = (data * 100).toFixed(2); // Mengubah ke persen dengan 2 angka desimal
                    let color;

                    // Tentukan warna berdasarkan nilai persen
                    if (percentage <= 25) {
                        color = '#f87171'; // Warna merah
                    } else if (percentage <= 50) {
                        color = '#facc15'; // Warna kuning
                    } else if (percentage <= 75) {
                        color = '#34d399'; // Warna hijau muda
                    } else {
                        color = '#10b981'; // Warna hijau tua
                    }

                    // Tampilkan progres dengan gaya kotak berwarna
                    return `
                        <div style="background-color: ${color}; color: white; padding: 5px; border-radius: 20px; text-align: center; width: 80px;">
                            ${percentage}%
                        </div>
                    `;
                }
            },
                    {
                        data: "deskripsi",
                        orderable: true,
                        searchable: true
                    }
                ]
            });

            // Reload tabel saat filter kategori diubah
            $('nama_kegiatan').on('change', function() {
                dataJenisKegiatan.ajax.reload(); // Memuat ulang tabel berdasarkan filter yang dipilih
            });
        });
    </script>
@endpush

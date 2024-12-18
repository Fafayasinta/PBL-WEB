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
                    <h6>Total Kegiatan</h6>
                    <div class="d-flex justify-content-center align-items-cent">
                        <div style="background-color: #ffd572; padding: 10px; display: inline-block; border-radius: 10px;">
                            <i class="nav-icon fas fa-box"></i>    
                        </div>
                        <h2 style="margin-left: 20px">{{ $totalKegiatan }}</h2>
                    </div>
                </div>
            </div>
        </div>
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
                        <div style="background-color: #6af3ae; padding: 10px; display: inline-block; border-radius: 10px;">
                            <i class="nav-icon fas fa-chart-bar"></i>    
                        </div>
                        <h2 style="margin-left: 20px">{{ $totalKegiatanProses }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="border-radius: 10px; border: 1px solid #ddd;">
                <div class="card-body">
                    <h6>Total Kegiatan Belum Dimulai</h6>
                    <div class="d-flex justify-content-center align-items-center">
                        <div style="background-color: #ffb398; padding: 10px; display: inline-block; border-radius: 10px;">
                            <i class="nav-icon fas fa-clock"></i>    
                        </div>
                        <h2 style="margin-left: 20px">{{ $totalKegiatanBelum }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table of Activities -->
    <div class="card mt-4" style="border-radius: 10px; border: 1px solid #ddd;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Kegiatan Jurusan Teknologi Informasi</h4>
            {{-- <div class="filter-container ml-auto" style="margin-right: 10px;">
                <select class="form-control" name="filter" style="font-size: 14px; width: auto; border-radius: 10px" required>
                    <option value="01" {{ request('month') == '01' ? 'selected' : '' }}>Januari</option>
                    <option value="02" {{ request('month') == '02' ? 'selected' : '' }}>Februari</option>
                    <option value="03" {{ request('month') == '03' ? 'selected' : '' }}>Maret</option>
                    <option value="04" {{ request('month') == '04' ? 'selected' : '' }}>April</option>
                    <option value="05" {{ request('month') == '05' ? 'selected' : '' }}>Mei</option>
                    <option value="06" {{ request('month') == '06' ? 'selected' : '' }}>Juni</option>
                    <option value="07" {{ request('month') == '07' ? 'selected' : '' }}>Juli</option>
                    <option value="08" {{ request('month') == '08' ? 'selected' : '' }}>Agustus</option>
                    <option value="09" {{ request('month') == '09' ? 'selected' : '' }}>September</option>
                    <option value="10" {{ request('month') == '10' ? 'selected' : '' }}>Oktober</option>
                    <option value="11" {{ request('month') == '11' ? 'selected' : '' }}>November</option>
                    <option value="12" {{ request('month') == '12' ? 'selected' : '' }}>Desember</option>
                </select>
            </div> --}}
        </div>             
        <div class="card-body">
            <table class="table-bordered table-striped table-hover table-sm table" id="table_admin" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 20%">Nama Kegiatan</th>
                        <th class="text-center">Waktu Mulai</th>
                        <th class="text-center">Waktu Akhir</th>
                        <th class="text-center">PIC</th>
                        <th class="text-center">Progres</th>
                        <th class="text-center">Keterangan</th>
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
    $(document).ready(function () {
        var dataAdmin = $('#table_admin').DataTable({
            serverSide: true, // Menggunakan server-side processing
            ajax: {
                "url": "{{ url('admin/list') }}", // Endpoint untuk mengambil data kegiatan
                "type": "POST",
                "data": function (d) {
                    d.nama_kegiatan = $('#nama_kegiatan').val(); // Kirim filter jika ada
                }
            },
            columns: [
                { data: "nama_kegiatan", orderable: true, searchable: true },
                {
                    data: "waktu_mulai",
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
                    data: "waktu_selesai",
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
                { data: "user.nama", orderable: true, searchable: true },
                {
                    data: "progres",
                    orderable: true,
                    searchable: false,
                    render: function (data, type, row) {
                        // Format progres dengan tampilan progress bar
                        let color;

                        if (data <= 25) {
                            color = '#f87171'; // Merah
                        } else if (data <= 50) {
                            color = '#facc15'; // Kuning
                        } else if (data <= 75) {
                            color = '#34d399'; // Hijau muda
                        } else {
                            color = '#10b981'; // Hijau tua
                        }

                        return `
                            <div style="background-color: ${color}; color: white; padding: 5px; border-radius: 20px; text-align: center; width: 80px;">
                                ${data}% 
                            </div>`;
                    }
                },
                { data: "keterangan", orderable: true, searchable: true }
            ]
        });

        // Filter berdasarkan nama kegiatan
        // $('#nama_kegiatan').on('change', function () {
        //     dataAdmin.ajax.reload(); // Reload DataTables dengan filter baru
        // });
    });
</script>
@endpush

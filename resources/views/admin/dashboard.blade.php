<!-- resources/views/dashboard.blade.php -->
@extends('admin.layouts.template')

@section('content')
<div class="card" style="border: 1px solid #ddd; padding: 20px; border-radius: 10px; background-color: #f9f9f9;">
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
            <table class="table-bordered table-striped table-hover table-sm table" id="table_pengguna" style="width: 100%">
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

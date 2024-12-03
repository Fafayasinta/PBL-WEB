@extends('dosenAnggota.layouts.template')

@section('content')
<div class="container-fluid">
    <!-- Stat Cards -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- Total Kegiatan Selesai -->
            <div class="small-box bg-light">
                <div class="inner">
                    <h3>9</h3>
                    <p>Total Kegiatan Selesai</p>
                    <span class="text-success">8.5% Up from yesterday</span>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle text-success"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- Total Kegiatan Dalam Progress -->
            <div class="small-box bg-light">
                <div class="inner">
                    <h3>4</h3>
                    <p>Total Kegiatan Dalam Progress</p>
                    <span class="text-info">1.3% Up from past week</span>
                </div>
                <div class="icon">
                    <i class="fas fa-cubes text-warning"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- Total Kegiatan Belum Mulai -->
            <div class="small-box bg-light">
                <div class="inner">
                    <h3>7</h3>
                    <p>Total Kegiatan Belum Mulai</p>
                    <span class="text-danger">4.3% Down from yesterday</span>
                </div>
                <div class="icon">
                    <i class="fas fa-clock text-info"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- Total Kegiatan Ditunda -->
            <div class="small-box bg-light">
                <div class="inner">
                    <h3>0</h3>
                    <p>Total Kegiatan Ditunda</p>
                    <span class="text-success">1.8% Up from yesterday</span>
                </div>
                <div class="icon">
                    <i class="fas fa-pause-circle text-danger"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card mt-3">
        <div class="card-header">
            <h4>Kegiatan Jurusan Teknologi Informasi</h4>
            <div class="card-tools">
                <select class="form-control">
                    <option>October</option>
                    <option>November</option>
                    <option>December</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Kegiatan</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Akhir</th>
                        <th>PIC</th>
                        <th>Progress</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Seminar Nasional 2024</td>
                        <td>1 September 2024</td>
                        <td>4 Oktober 2024</td>
                        <td>Vit Zuraida</td>
                        <td><span class="badge badge-success">100%</span></td>
                        <td>LPJ telah diserahkan</td>
                    </tr>
                    <tr>
                        <td>JTI Play IT!</td>
                        <td>14 Oktober 2024</td>
                        <td>16 Januari 2025</td>
                        <td>Dika Rizki</td>
                        <td><span class="badge badge-warning">80%</span></td>
                        <td>Pengerjaan LPJ</td>
                    </tr>
                    <tr>
                        <td>Dialog Dosen Mahasiswa 2024</td>
                        <td>25 Oktober 2024</td>
                        <td>17 November 2024</td>
                        <td>Atiqah Nurul</td>
                        <td><span class="badge badge-danger">25%</span></td>
                        <td>Rapat Koordinasi dengan HMTI</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@extends('admin.layouts.template')

@section('content')
<style>
    .chart-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        margin-top: 20px;
        flex-wrap: wrap;
        width: 100%;
    }

    .card {
        flex: 1 1 50%;
        max-width: 100%;
        background: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .card-top {
        padding: 10px 15px;
        background-color: #f4f4f9;
        border-bottom: 1px solid #ddd;
    }

    .card h4 {
        margin: 0;
        font-size: 18px;
    }

    .card canvas {
        width: 90%; /* Menyesuaikan dengan ukuran kontainer */
        max-width: 500px; /* Membatasi lebar chart */
        height: 300px; /* Menentukan tinggi chart */
        margin: 0 auto; /* Membuat chart terpusat */
    }

    @media (max-width: 768px) {
        .card canvas {
            width: 100%; /* Ukuran penuh untuk perangkat mobile */
            height: 250px; /* Lebih kecil pada perangkat mobile */
        }
    }
</style>


<div class="card" style="border: 1px solid #ddd; padding: 20px; background-color: #f9f9f9; margin: 20px;">
    <div class="card-header">
        {{-- <div class="filter-container ml-auto">
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
    <div class="card-body d-flex justify-content-between align-items-center">
        <div class="chart-row">
            <!-- Statistik 1 -->
            <div class="card">
                <div class="card-top">
                    <h4>STATISTIK JENIS KEGIATAN DOSEN</h4>
                </div>
                <div>
                    <canvas id="donutChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div><br>
            </div>
        </div>
    </div>    
    <div class="card-body">
        <table class="table-bordered table-striped table-hover table-sm table" id="table_statistik" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">NAMA DOSEN</th>
                    <th class="text-center">JTI TERPROGRAM</th>
                    <th class="text-center">JTI NON PROGRAM</th>
                    <th class="text-center">NON JTI</th>
                    <th class="text-center">TOTAL KEGIATAN</th>
                </tr>
            </thead>
            <tbody>
                @foreach($statistik as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $item->user->nama }}</td>
                    <td class="text-center">{{ $item->total_kategori_1 }}</td>
                    <td class="text-center">{{ $item->total_kategori_2 }}</td>
                    <td class="text-center">{{ $item->total_kategori_3 }}</td>
                    <td class="text-center">{{ $item->total_kegiatan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const chartData = @json($chartData);
        const ctx1 = document.getElementById("donutChart1").getContext("2d");
        new Chart(ctx1, {
            type: "doughnut",
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "top",
                    },
                },
            },
        });
    });
</script>
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        })
    }
    var dataStatistik;
    $(document).ready(function () {
    $('#table_pengguna').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: "{{ url('statistik/list') }}",
            type: "POST"
        },
        columns: [
            { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
            { data: "user_id", className: "text-center" },
            { data: "total_kategori_1", className: "text-center" },
            { data: "total_kategori_2", className: "text-center" },
            { data: "total_kategori_3", className: "text-center" }
        ]
    });
});
</script>
@endsection

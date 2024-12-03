@extends('pimpinan.layouts.template')

@section('content')
<style>
.chart-row {
  display: flex !important; /* Menempatkan elemen dalam satu baris */
  justify-content: space-between !important; /* Menyebarkan elemen dengan jarak yang sama */
  gap: 20px !important; /* Memberikan spasi antar card */
  margin-top: 20px !important; /* Memberikan margin atas antara baris */
  width: 100% !important; /* Memastikan baris mengisi seluruh lebar layar */
  flex-wrap: wrap !important; /* Membungkus elemen ke baris baru jika ruang terbatas */
}

.card {
  flex: 1 1 50% !important; /* Membuat setiap card memiliki ukuran yang fleksibel, 2 card dalam satu baris */
  max-width: 100% !important; /* Batas lebar maksimal card untuk setiap chart */
  background: #ffffff !important; /* Warna latar belakang card */
  border: 1px solid #ddd !important; /* Menambahkan border */
  border-radius: 8px !important; /* Membuat sudut kartu membulat */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important; /* Bayangan lembut */
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
  width: 100%; /* Membuat canvas memenuhi lebar card */
  height: auto; /* Menyesuaikan tinggi canvas secara proporsional */
}
</style>

<div class="card" style="border: 1px solid #ddd; padding: 20px; border-radius: 0px; background-color: #f9f9f9; margin: 20px; margin-top: 0px;">
    <div class="card-header">
        <div class="filter-container ml-auto">
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
        </div>
    </div>
    <div class="card-body d-flex justify-content-between align-items-center">
        <!-- First Row: Donut Chart 1 and 2 -->
        <div class="chart-row">
            <!-- Donut Chart Left 1 -->
            <div class="card">
                <div class="card-top">
                    <h4>Chart 1</h4>
                </div>
                <div>
                    <canvas id="donutChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
          
            <!-- Donut Chart Right 1 -->
            <div class="card">
                <div class="card-top">
                    <h4>Chart 2</h4>
                </div>
                <div>
                    <canvas id="donutChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>   

        <!-- Second Row: Donut Chart 3 and 4 -->
        <div class="chart-row">
            <!-- Donut Chart Left 2 -->
            <div class="card">
                <div class="card-top">
                    <h4>Chart 3</h4>
                </div>
                <div>
                    <canvas id="donutChart3" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
          
            <!-- Donut Chart Right 2 -->
            <div class="card">
                <div class="card-top">
                    <h4>Chart 4</h4>
                </div>
                <div>
                    <canvas id="donutChart4" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>   
    </div>
</div>
@endsection

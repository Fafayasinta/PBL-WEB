<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex align-items-center">
            <label class="mr-2">Filter</label>
            <select class="form-control mr-2" style="width: 200px;">
              <option value="">- Semua -</option>
              <option value="Terprogram">Terprogram</option>
              <option value="Non Program">Non Program</option>
            </select>
            <select class="form-control" style="width: 200px;">
              <option value="">- Semua -</option>
              <option value="Proses">Proses</option>
              <option value="Selesai">Selesai</option>
              <option value="Belum Proses">Belum Proses</option>
            </select>
          </div>

          <div class="d-flex align-items-center">
            <label class="mr-2">Show</label>
            <select class="form-control" style="width: 60px;">
              <option>10</option>
              <option>25</option>
              <option>50</option>
              <option>100</option>
            </select>
            <label class="ml-2">entries</label>
          </div>

          <input type="search" class="form-control" placeholder="Search" style="width: 200px;">
        </div>

        <table class="table table-hover">
          <thead>
            <tr>
              <th>NO</th>
              <th>NAMA</th>
              <th>DESKRIPSI</th>
              <th>JENIS</th>
              <th>STATUS</th>
              <th>BEBAN KERJA</th>
              <th>AKSI</th>
            </tr>
          </thead>
          <tbody>
            @foreach($kegiatan as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $item->nama_kegiatan }}</td>
              <td>{{ $item->deskripsi }}</td>
              <td>{{ $item->kategori->nama_kategori }}</td>
              <td>
                @if($item->status == 'Proses')
                  <span class="badge badge-warning">Proses</span>
                @elseif($item->status == 'Selesai') 
                  <span class="badge badge-success">Selesai</span>
                @else
                  <span class="badge badge-danger">Belum Proses</span>
                @endif
              </td>
              <td>{{ $item->beban_kegiatan_id == 1 ? 'Berat' : ($item->beban_kegiatan_id == 2 ? 'Sedang' : 'Ringan') }}</td>
              <td>
                <a href="{{ route('kegiatan.detail', $item->kegiatan_id) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('kegiatan.edit', $item->kegiatan_id) }}" class="btn btn-warning btn-sm">Edit</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="mt-3">
          Showing 1 to {{ $kegiatan->count() }} of {{ $kegiatan->count() }} entries
        </div>
      </div>
    </div>
  </div>
</section>
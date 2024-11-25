@extends('admin.layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            {{-- <h3 class="card-title">{{ $page->title }}</h3> --}}
            <div class="card-tools">
                <button onclick="#"class="btn btn-success" style="font-size: 16px; background-color: #17A2B8; color: white; border: none; border-radius: 15px; padding: 8px 30px; margin-right: 15px">Tambah</button>
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
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter</label>
                        <div class="col-3">
                            <select type="text" class="form-control" id="" name="" required>
                                <option value="">Semua</option>
                                {{-- @foreach ($level as $item)
                                    <option value="{{ $item->level_kode }}">{{ $item->level_kode }}</option>
                                @endforeach --}}
                            </select>
                            <small class="form-text text-muted">Jenis Kegiatan</small>
                        </div>
                        <div class="col-3">
                            <select type="text" class="form-control" id="" name="" required>
                                <option value="">Semua</option>
                                {{-- @foreach ($level as $item)
                                    <option value="{{ $item->level_kode }}">{{ $item->level_kode }}</option>
                                @endforeach --}}
                            </select>
                            <small class="form-text text-muted">Status</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table-bordered table-striped table-hover table-sm table" id="table_kegiatanjti" style="width: 100%">
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
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
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
        var dataLevel;
        $(document).ready(function() {
            dataKegiatanJti = $('#table_kegiatanjti').DataTable({
                serverSide: true, // Menggunakan server-side processing
                ajax: {
                    "url": "#", // Endpoint untuk mengambil data kategori
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.level_kode = $('#').val(); // Mengirim data filter kategori_kode
                    }
                },
                columns: [{
                        data: "DT_RowIndex", // Menampilkan nomor urut dari Laravel DataTables addIndexColumn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "level_kode",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "level_nama",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "action", // Kolom aksi (Edit, Hapus)
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Reload tabel saat filter kategori diubah
            $('#').on('change', function() {
                dataLevel.ajax.reload(); // Memuat ulang tabel berdasarkan filter yang dipilih
            });
        });
    </script>
@endpush
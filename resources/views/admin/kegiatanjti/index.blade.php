@extends('admin.layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header"><br>
            {{-- <h3 class="card-title">{{ $page->title }}</h3> --}}
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/kegiatanjti/create_ajax') }}')"class="btn btn-success" style="font-size: 16px; background-color: #17A2B8; color: white; border: none; border-radius: 15px; padding: 8px 30px; margin-right: 15px">Tambah</button>
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
                    {{-- <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter</label>
                        <div class="col-3">
                            <select type="text" class="form-control" id="status" name="status" required>
                                <option value="">Semua</option>
                                @foreach ($status as $item)
                                    <option value="{{ $item->status }}">{{ $item->status }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Jenis Kegiatan</small>
                        </div>
                    </div> --}}
                </div>
                <br>
            </div>
            <table class="table-bordered table-striped table-hover table-sm table" id="table_kegiatanjti" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center" style="width: 15%">NAMA</th>
                        <th class="text-center" style="width: 20%">DESKRIPSI</th>
                        <th class="text-center">JENIS</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">BEBAN KERJA</th>
                        <th class="text-center">AKSI</th>
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
        var dataKegiatanJti;
        $(document).ready(function() {
            dataKegiatanJti = $('#table_kegiatanjti').DataTable({
                serverSide: true, // Menggunakan server-side processing
                ajax: {
                    "url": "{{ url('kegiatanjti/list') }}", // Endpoint untuk mengambil data kategori
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.status = $('#kegiatanjti').val(); // Mengirim data filter kategori_kode
                    }
                },
                columns: [{
                        data: "DT_RowIndex", // Menampilkan nomor urut dari Laravel DataTables addIndexColumn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama_kegiatan",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "deskripsi",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "kategori.nama_kategori",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "status",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "beban.nama_beban",
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
            $('#status').on('change', function() {
                dataKegiatanJti.ajax.reload(); // Memuat ulang tabel berdasarkan filter yang dipilih
            });
        });
    </script>
@endpush
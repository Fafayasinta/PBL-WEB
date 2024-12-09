@extends('admin.layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <br>
            {{-- <h3 class="card-title">{{ $page->title }}</h3> --}}
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/jabatankegiatan/create_ajax') }}')"class="btn btn-success" style="font-size: 16px; background-color: #17A2B8; color: white; border: none; border-radius: 15px; padding: 8px 30px; margin-right: 15px">Tambah</button>
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
                            <select type="text" class="form-control" id="jabatan" name="jabatan" required>
                                <option value="">Semua</option>
                                @foreach ($jabatankegiatan as $item)
                                    <option value="{{ $item->jabatan }}">{{ $item->jabatan }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Kelola Jabatan Kegiatan</small>
                        </div>
                    </div> --}}
                </div>
            </div>
            <table class="table-bordered table-striped table-hover table-sm table" id="table_jabatankegiatan" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">CAKUPAN WILAYAH</th>
                        <th class="text-center">JABATAN</th>
                        <th class="text-center">SKOR</th>
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
        var dataJabatanKegiatan;
        $(document).ready(function() {
            dataJabatanKegiatan = $('#table_jabatankegiatan').DataTable({
                serverSide: true, // Menggunakan server-side processing
                ajax: {
                    "url": "{{ url('jabatankegiatan/list') }}", // Endpoint untuk mengambil data kategori
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.jabatan = $('#jabatan').val(); // Mengirim data filter kategori_kode
                    }
                },
                columns: [{
                        data: "DT_RowIndex", // Menampilkan nomor urut dari Laravel DataTables addIndexColumn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "cakupan_wilayah",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "jabatan",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "skor",
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
            // $('jabatan').on('change', function() {
            //     dataJabatanKegiatan.ajax.reload(); // Memuat ulang tabel berdasarkan filter yang dipilih
            // });
        });
    </script>
@endpush
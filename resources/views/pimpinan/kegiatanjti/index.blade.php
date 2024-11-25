@extends('admin.layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="card-tools">
                <button onclick="modalAction('{{ route('kegiatan.create') }}')" class="btn btn-success" style="font-size: 16px; background-color: #17A2B8; color: white; border: none; border-radius: 15px; padding: 8px 30px; margin-right: 15px">
                    Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- Filter Kegiatan --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter</label>
                        <div class="col-3">
                            <select class="form-control" id="filter_jenis" name="filter_jenis">
                                <option value="">Semua</option>
                                <option value="Terprogram">Terprogram</option>
                                <option value="Non Program">Non Program</option>
                            </select>
                            <small class="form-text text-muted">Jenis Kegiatan</small>
                        </div>
                        <div class="col-3">
                            <select class="form-control" id="filter_status" name="filter_status">
                                <option value="">Semua</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Belum Proses">Belum Proses</option>
                            </select>
                            <small class="form-text text-muted">Status</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Kegiatan --}}
            <table class="table table-bordered table-striped table-hover table-sm" id="table_kegiatanjti" style="width: 100%">
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

    {{-- Modal --}}
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true"></div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@push('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function () {
                $('#myModal').modal('show');
            });
        }

        $(document).ready(function () {
            const dataKegiatanJti = $('#table_kegiatanjti').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('kegiatan.data') }}", // Ganti dengan endpoint API data kegiatan
                    type: "POST",
                    data: function (d) {
                        d.jenis = $('#filter_jenis').val();
                        d.status = $('#filter_status').val();
                    }
                },
                columns: [
                    { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                    { data: "nama_kegiatan", className: "text-left" },
                    { data: "deskripsi", className: "text-left" },
                    { data: "jenis", className: "text-center" },
                    { 
                        data: "status", 
                        className: "text-center",
                        render: function (data) {
                            if (data === "Proses") return '<span class="badge badge-warning">Proses</span>';
                            if (data === "Selesai") return '<span class="badge badge-success">Selesai</span>';
                            if (data === "Belum Proses") return '<span class="badge badge-danger">Belum Proses</span>';
                            return data;
                        }
                    },
                    { data: "beban_kerja", className: "text-center" },
                    {
                        data: "action",
                        className: "text-center",
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return `<button onclick="modalAction('${row.edit_url}')" class="btn btn-info btn-sm">Detail</button>`;
                        }
                    }
                ],
                order: [[1, 'asc']],
            });

            // Reload tabel ketika filter berubah
            $('#filter_jenis, #filter_status').on('change', function () {
                dataKegiatanJti.ajax.reload();
            });
        });
    </script>
@endpush

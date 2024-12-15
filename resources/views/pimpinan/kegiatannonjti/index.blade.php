@extends('pimpinan.layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            {{-- <h3 class="card-title">{{ $page->title }}</h3> --}}
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/kegiatannonjti/create_ajax') }}')"class="btn btn-success" style="font-size: 16px; background-color: #17A2B8; color: white; border: none; border-radius: 15px; padding: 8px 30px; margin-right: 15px">Tambah</button>
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
                    </div>
                </div>
            </div>
            <table class="table-bordered table-striped table-hover table-sm table" id="table_kegiatannonjti" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center" style="width: 20%">NAMA KEGIATAN</th>
                        <th class="text-center" style="width: 15%">NAMA DOSEN</th>
                        <th class="text-center">JENIS</th>
                        <th class="text-center">WILAYAH KERJA</th>
                        <th class="text-center">WAKTU</th>
                        <th class="text-center">BEBAN</th>
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
        var dataKegiatanNonJti;
        $(document).ready(function() {
            dataKegiatanNonJti = $('#table_kegiatannonjti').DataTable({
                serverSide: true, // Menggunakan server-side processing
                ajax: {
                    "url": "{{ url('kegiatannonjti/list')}}", // Endpoint untuk mengambil data kategori
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.cakupan_wilayah = $('#cakupan_wilayah').val(); // Mengirim data filter kategori_kode
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
                        data: "user.nama",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "kategori.nama_kategori",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "cakupan_wilayah",
                        orderable: true,
                        searchable: true
                    },
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
            $('#').on('change', function() {
                dataLevel.ajax.reload(); // Memuat ulang tabel berdasarkan filter yang dipilih
            });
        });
    </script>
@endpush
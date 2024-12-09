@extends('admin.layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <br>
            {{-- <h3 class="card-title">{{ $page->title }}</h3> --}}
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/agenda/create_ajax') }}')"class="btn btn-success" style="font-size: 16px; background-color: #17A2B8; color: white; border: none; border-radius: 15px; padding: 8px 30px; margin-right: 15px">Tambah</button>
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
                            <select type="text" class="form-control" id="kegiatan_id" name="kegiatan_id" required>
                                <option value="">Semua</option>
                                @foreach ($agendaUnique as $item)
                                    <option value="{{ $item->kegiatan_id }}">{{ $item->kegiatan->nama_kegiatan }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Pilih Kegiatan</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table-bordered table-striped table-hover table-sm table" id="table_agenda" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">NAMA AGENDA</th>
                        <th class="text-center" style="width: 20%">PENANGGUNG JAWAB</th>
                        <th class="text-center" >DEADLINE</th>
                        <th class="text-center">LOKASI</th>
                        <th class="text-center" style="width: 20%">KETERANGAN</th>
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
        var dataAgenda;
        $(document).ready(function() {
            dataAgenda = $('#table_agenda').DataTable({
                serverSide: true, // Menggunakan server-side processing
                ajax: {
                    "url": "{{ url('agenda/list') }}", // Endpoint untuk mengambil data kategori
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.kegiatan_id = $('#kegiatan_id').val(); // Mengirim data filter kategori_kode
                    }
                },
                columns: [{
                        data: "DT_RowIndex", // Menampilkan nomor urut dari Laravel DataTables addIndexColumn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama_agenda",
                        // className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "user.nama",
                        // className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "deadline",
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
                        data: "lokasi",
                        // className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "keterangan",
                        // className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "action", // Kolom aksi (Edit, Hapus)
                        // className: "text-center",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Reload tabel saat filter kategori diubah
            $('#kegiatan_id').on('change', function() {
                dataAgenda.ajax.reload(); // Memuat ulang tabel berdasarkan filter yang dipilih
            });
        });
    </script>
@endpush
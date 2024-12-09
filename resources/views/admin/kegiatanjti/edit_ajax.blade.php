@empty($kegiatanjti)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan</div>
                <a href="{{ url('/kegiatanjti') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/kegiatanjti/' . $kegiatanjti->kegiatan_id.'/update_ajax') }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Kegiatan JTI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>NAMA</label>
                    <input value="{{ $kegiatanjti->nama_kegiatan }}" type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required>
                    <small id="error-nama_kegiatan" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>DESKRIPSI</label>
                    <input value="{{ $kegiatanjti->deskripsi }}" type="text" name="deskripsi" id="deskripsi" class="form-control" required>
                    <small id="error-deskripsi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>JENIS KEGIATAN</label>
                    <select name="kategori_kegiatan_id" id="kategori_kegiatan_id" class="form-control" required>
                        <option value="">Pilih Jenis</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->kategori_kegiatan_id }}" {{ $kegiatanjti->kategori_kegiatan_id == $k->kategori_kegiatan_id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                            
                        @endforeach
                    </select>
                    <small id="error-kategori_kegiatan_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>STATUS</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Pilih Status</option>
                        <option value="Belum Proses" {{ $kegiatanjti->status == 'Belum Proses' ? 'selected' : '' }}>Belum Proses</option>
                        <option value="Proses" {{ $kegiatanjti->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Selesai" {{ $kegiatanjti->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <small id="error-status" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>BEBAN KERJA</label>
                    <select name="beban_kegiatan_id" id="beban_kegiatan_id" class="form-control" required>
                        <option value="">Pilih Beban Kerja</option>
                        @foreach($beban as $b)
                            <option value="{{ $b->beban_kegiatan_id }}" {{ $kegiatanjti->beban_kegiatan_id == $b->beban_kegiatan_id ? 'selected' : '' }}>
                                {{ $b->nama_beban }}
                            </option>
                        @endforeach
                    </select>
                    <small id="error-beban_kegiatan_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>DAFTAR ANGGOTA KEGIATAN</label>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered align-middle">
                            <tbody id="anggota-list">
                                @foreach($anggota as $anggota)
                                <tr>
                                    <td class="text-left">{{ $anggota->user->nama }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="text-center">
                                        <button type="button" id="add-anggota-btn" class="btn btn-success btn-sm fw-bold" style="font-size: 16px; background-color: #17A2B8; color: white; border: none; border-radius: 15px; padding: 6px 25px; margin-right: 15px">
                                            + Tambahkan Data
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
    </form>
    <script>
        $(document).ready(function() {
            $("#form-edit").validate({
                rules: {
                    kategori_kegiatan_id: {required: true, number: true},
                    beban_kegiatan_id: {required: true, number: true},
                    nama_kegiatan: {required: true, maxlenght: 100},
                    deskripsi: {required: true, maxlenght: 255},
                    status: {required: true},
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if(response.status){
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataKegiatanJti.ajax.reload();
                            }else{
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-'+prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty
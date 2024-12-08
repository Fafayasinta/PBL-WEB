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
                    <label>JENIS</label>
                    <input value="{{ $kegiatanjti->kategori->nama_kategori }}" type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
                    <small id="error-nama_kategori" class="error-text form-text text-danger"></small>
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
                    <input value="{{ $kegiatanjti->beban->nama_beban }}" type="text" name="nama_beban" id="nama_beban" class="form-control" required>
                    <small id="error-nama_beban" class="error-text form-text text-danger"></small>
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
                    nama_kegiatan: {required: true, maxlenght: 100},
                    deskripsi: {required: true, maxlenght: 255},
                    nama_kategori: {required: true, maxlenght: 100},
                    status: {
                        required: true,
                        inArray: ["Belum Proses", "Proses", "Selesai"], // Validasi nilai hanya pada daftar opsi.
                    },
                    nama_beban: {required: true, maxlenght: 100},
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
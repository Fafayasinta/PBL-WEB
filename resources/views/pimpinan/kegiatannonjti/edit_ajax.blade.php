@empty($kegiatannonjti)
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
                <a href="{{ url('/kegiatannonjti') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/kegiatannonjti/' . $kegiatannonjti->kegiatan_id.'/update_ajax') }}" method="POST" id="form-edit">
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
                    <label>NAMA KEGIATAN</label>
                    <input value="{{ $kegiatannonjti->nama_kegiatan }}" type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required>
                    <small id="error-nama_kegiatan" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>NAMA DOSEN</label>
                    <input value="{{ $kegiatannonjti->pic }}" type="text" name="pic" id="pic" class="form-control" required>
                    <small id="error-pic" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>JENIS</label>
                    <input value="{{ $kegiatannonjti->kategori->nama_kategori }}" type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
                    <small id="error-nama_kategori" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>WILAYAH KERJA</label>
                    <select name="cakupan_wilayah" id="cakupan_wilayah" class="form-control" required>
                        <option value="">Pilih Wilayah Kerja</option>
                        <option value="Luar Institusi" {{ $kegiatannonjti->cakupan_wilayah == 'Luar Institusi' ? 'selected' : '' }}>Luar Institusi</option>
                        <option value="Institusi" {{ $kegiatannonjti->cakupan_wilayah == 'Institusi' ? 'selected' : '' }}>Institusi</option>
                        <option value="Jurusan" {{ $kegiatannonjti->cakupan_wilayah == 'Jurusan' ? 'selected' : '' }}>Jurusan</option>
                        <option value="Program Studi" {{ $kegiatannonjti->cakupan_wilayah == 'Program Studi' ? 'selected' : '' }}>Program Studi</option>
                    </select>
                    <small id="error-cakupan_wilayah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>WAKTU MULAI</label>
                    <input 
                        type="datetime-local" 
                        name="waktu_mulai" 
                        id="waktu_mulai" 
                        class="form-control" 
                        value="{{ $kegiatannonjti->waktu_mulai ? \Carbon\Carbon::parse($kegiatannonjti->waktu_mulai)->format('Y-m-d\TH:i') : '' }}" 
                        required>
                    <small id="error-waktu_mulai" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>BEBAN KERJA</label>
                    <input value="{{ $kegiatannonjti->beban->nama_beban }}" type="text" name="nama_beban" id="nama_beban" class="form-control" required>
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
                    nama_kegiatan: {required: true, maxlenght: 200},
                    pic: {required: true, maxlenght: 100},
                    nama_kategori: {required: true, maxlenght: 100},
                    cakupan_wilayah: {
                        required: true,
                        inArray: ["Luar Institusi", "Institusi", "Jurusan", "Program Studi"], // Validasi nilai hanya pada daftar opsi.
                    },
                    waktu_mulai: {required: true, date},
                    nama_beban: {required: true, maxlenght: 100},
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if(response.cakupan_wilayah){
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataKegiatanNonJti.ajax.reload();
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
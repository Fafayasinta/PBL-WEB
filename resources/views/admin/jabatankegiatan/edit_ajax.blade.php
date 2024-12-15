@empty($jabatankegiatan)
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
                <a href="{{ url('/jabatankegiatan') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/jabatankegiatan/' . $jabatankegiatan->bobot_jabatan_id.'/update_ajax') }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Edit Jabatan Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>WILAYAH KERJA</label>
                    <select name="cakupan_wilayah" id="cakupan_wilayah" class="form-control" required>
                        <option value="">Pilih Wilayah Kerja</option>
                        <option value="Luar Institusi" {{ $jabatankegiatan->cakupan_wilayah == 'Luar Institusi' ? 'selected' : '' }}>Luar Institusi</option>
                        <option value="Institusi" {{ $jabatankegiatan->cakupan_wilayah == 'Institusi' ? 'selected' : '' }}>Institusi</option>
                        <option value="Jurusan" {{ $jabatankegiatan->cakupan_wilayah == 'Jurusan' ? 'selected' : '' }}>Jurusan</option>
                        <option value="Program Studi" {{ $jabatankegiatan->cakupan_wilayah == 'Program Studi' ? 'selected' : '' }}>Program Studi</option>
                    </select>
                    <small id="error-cakupan_wilayah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>JABATAN</label>
                    <select name="jabatan" id="jabatan" class="form-control" required>
                        <option value="">Pilih Jabatan</option>
                        <option value="PIC" {{ $jabatankegiatan->jabatan == 'PIC' ? 'selected' : '' }}>PIC</option>
                        <option value="Sekretaris" {{ $jabatankegiatan->jabatan == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                        <option value="Bendahara" {{ $jabatankegiatan->jabatan == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                        <option value="Anggota" {{ $jabatankegiatan->jabatan == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                    </select>
                    <small id="error-jabatan" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>SKOR</label>
                    <input value="{{ $jabatankegiatan->skor }}" type="text" name="skor" id="skor" class="form-control" required>
                    <small id="error-skor" class="error-text form-text text-danger"></small>
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
                    cakupan_wilayah: {required: true},
                    jabatan: {required: true},
                    skor: {required: true, minlength: 3, maxlength: 100, number: true},
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
                                dataJabatanKegiatan.ajax.reload();
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
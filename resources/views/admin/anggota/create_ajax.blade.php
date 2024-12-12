<form action="{{ url('/anggota/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah anggota Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>NAMA KEGIATAN</label>
                    <select name="kegiatan_id" id="kegiatan_id" class="form-control" required>
                        <option value="">Pilih Kegiatan</option>
                        @foreach($kegiatan as $k)
                            <option value="{{ $k->kegiatan_id }}">{{ $k->nama_kegiatan }}</option>
                        @endforeach
                    </select>
                    <small id="error-kegiatan_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label> NAMA DOSEN</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Pilih Dosen</option>
                        @foreach($user as $u)
                            <option value="{{ $u->user_id }}">{{ $u->nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-user_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>JABATAN</label>
                    <select name="jabatan" id="jabatan" class="form-control" required>
                        <option value="">Pilih Status</option>
                        <option value="PIC">PIC</option>
                        <option value="Sekretaris">Sekretaris</option>
                        <option value="Bendahara">Bendahara</option>
                        <option value="Anggota">Anggota</option>
                    </select>
                    <small id="error-jabatan" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>SKOR</label>
                    <input value="" type="text" name="skor" id="skor" class="form-control" required>
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
            $("#form-tambah").validate({
                rules: {
                    kegiatan_id: {required: true, number: true},
                    user_id: {required: true, number: true},
                    jabatan: { required: true},
                    skor: {required: true, number: true},
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
                                dataAnggotaKegiatanJti.ajax.reload();
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
@empty($anggota)
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
    <form action="{{ url('/anggota/' . $anggota->anggota_id.'/update_ajax') }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Edit anggota Kegiatan</h5>
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
                            <option value="{{ $k->kegiatan_id }}" {{ $anggota->kegiatan_id == $k->kegiatan_id ? 'selected' : '' }}>
                                {{ $k->nama_kegiatan }}
                            </option>
                        @endforeach
                    </select>
                    <small id="error-kegiatan_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>NAMA DOSEN</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Pilih Dosen</option>
                        @foreach($user as $u)
                            <option value="{{ $u->user_id }}" {{ $anggota->user_id == $k->user_id ? 'selected' : '' }}>
                                {{ $u->nama }}
                            </option>
                        @endforeach
                    </select>
                    <small id="error-user_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>JABATAN</label>
                    <select name="jabatan" id="jabatan" class="form-control" required>
                        <option value="">Pilih Jabatan</option>
                        <option value="PIC" {{ $anggota->jabatan == 'PIC' ? 'selected' : '' }}>PIC</option>
                        <option value="Sekretaris" {{ $anggota->jabatan == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                        <option value="Bendahara" {{ $anggota->jabatan == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                        <option value="Anggota" {{ $anggota->jabatan == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                    </select>
                    <small id="error-jabatan" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>BOBOT</label>
                    <input value="{{ $anggota->skor }}" type="text" name="skor" id="skor" class="form-control" required>
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
                    kegiatan_id: {required: true, number: true},
                    user_id: {required: true, number: true},
                    jabatan: {required: true},
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
                                dataAgendaKegiatanJti.ajax.reload();
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
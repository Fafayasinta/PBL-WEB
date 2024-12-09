<form action="{{ url('/agenda/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Agenda Kegiatan</h5>
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
                    <label>NAMA AGENDA</label>
                    <input value="" type="text" name="nama_agenda" id="nama_agenda" class="form-control" required>
                    <small id="error-nama_agenda" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>PENANGGUNG JAWAB</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Pilih Dosen</option>
                        @foreach($user as $u)
                            <option value="{{ $u->user_id }}">{{ $u->nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-user_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>DEADLINE</label>
                    <input 
                        type="date" 
                        name="deadline" 
                        id="deadline" 
                        class="form-control" 
                        value="{{ isset($agenda->deadline) ? \Carbon\Carbon::parse($agenda->deadline)->format('Y-m-d') : '' }}" 
                        required>
                    <small id="error-deadline" class="error-text form-text text-danger"></small>
                </div>  
                <div class="form-group">
                    <label>LOKASI</label>
                    <input value="" type="text" name="lokasi" id="lokasi" class="form-control" required>
                    <small id="error-lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>PROGRES</label>
                    <input value="" type="text" name="progres" id="progres" class="form-control" placeholder="Masukkan nilai 0.00 - 1.00" required>
                    <small id="error-progres" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>KETERANGAN</label>
                    <input value="" type="text" name="keterangan" id="keterangan" class="form-control" required>
                    <small id="error-keterangan" class="error-text form-text text-danger"></small>
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
                    nama_agenda: {required: true},
                    user_id: {required: true, number: true},
                    deadline: { required: true, date: true },
                    lokasi: {required: true},
                    progres: {required: true, number: true},
                    keterangan: {required: true},
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
                                dataAgenda.ajax.reload();
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
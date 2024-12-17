@empty($agenda)
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
    <form action="{{ url('/agenda/' . $agenda->agenda_id.'/update_ajax') }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Edit Agenda Kegiatan</h5>
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
                            <option value="{{ $k->kegiatan_id }}" {{ $agenda->kegiatan_id == $k->kegiatan_id ? 'selected' : '' }}>
                                {{ $k->nama_kegiatan }}
                            </option>
                        @endforeach
                    </select>
                    <small id="error-kegiatan_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>NAMA AGENDA</label>
                    <input value="{{ $agenda->nama_agenda }}" type="text" name="nama_agenda" id="nama_agenda" class="form-control" required>
                    <small id="error-nama_agenda" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>PENANGGUNG JAWAB</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Pilih Dosen</option>
                        @foreach($user as $u)
                            <option value="{{ $u->user_id }}" {{ $agenda->user_id == $k->user_id ? 'selected' : '' }}>
                                {{ $u->nama }}
                            </option>
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
                        value="{{ $agenda->deadline ? \Carbon\Carbon::parse($agenda->deadline)->format('Y-m-d\TH:i') : '' }}" 
                        required>
                    <small id="error-deadline" class="error-text form-text text-danger"></small>
                </div>  
                <div class="form-group">
                    <label>LOKASI</label>
                    <input value="{{ $agenda->lokasi }}" type="text" name="lokasi" id="lokasi" class="form-control" required>
                    <small id="error-lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>WILAYAH KERJA</label>
                    <select name="cakupan_wilayah" id="cakupan_wilayah" class="form-control" required>
                        <option value="">Pilih Wilayah Kerja</option>
                        <option value="1.00">Luar Institusi</option>
                        <option value="0.00">Institusi</option>
                    </select>
                    <small id="error-cakupan_wilayah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>KETERANGAN</label>
                    <input value="{{ $agenda->keterangan }}" type="text" name="keterangan" id="keterangan" class="form-control" required>
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
            $("#form-edit").validate({
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
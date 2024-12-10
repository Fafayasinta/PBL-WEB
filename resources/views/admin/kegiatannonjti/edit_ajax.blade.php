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
                    <label> JENIS KEGIATAN</label>
                    <select name="kategori_kegiatan_id" id="kategori_kegiatan_id" class="form-control" required>
                        <option value="">Pilih Jenis Kegiatan</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->kategori_kegiatan_id }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                    <small id="error-kategori_kegiatan_id" class="error-text form-text text-danger"></small>
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
                    <label>WAKTU PELAKSANAAN</label>
                    <input 
                        type="date" 
                        name="waktu_mulai" 
                        id="waktu_mulai" 
                        class="form-control" 
                        value="{{ $kegiatannonjti->waktu_mulai ? \Carbon\Carbon::parse($kegiatannonjti->waktu_mulai)->format('Y-m-d\TH:i') : '' }}" 
                        required>
                    <small id="error-waktu_mulai" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label> BEBAN KEGIATAN</label>
                    <select name="beban_kegiatan_id" id="beban_kegiatan_id" class="form-control" required>
                        <option value="">Pilih Beban Kegiatan</option>
                        @foreach($beban as $b)
                            <option value="{{ $b->beban_kegiatan_id }}">{{ $b->nama_beban }}</option>
                        @endforeach
                    </select>
                    <small id="error-beban_kegiatan_id" class="error-text form-text text-danger"></small>
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
                    user_id: {required: true, number: true},
                    kategori_id: {required: true, number: true},
                    beban_kegiatan_id: {required: true, number: true},
                    nama_kegiatan: {required: true, maxlenght: 200},
                    cakupan_wilayah: {
                        required: true,
                        inArray: ["Luar Institusi", "Institusi", "Jurusan", "Program Studi"], // Validasi nilai hanya pada daftar opsi.
                    },
                    waktu_mulai: {required: true, date},
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
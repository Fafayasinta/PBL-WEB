<form action="{{ url('/kegiatannonjti/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>NAMA KEGIATAN</label>
                    <input value="" type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required>
                    <small id="error-nama_kegiatan" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>DESKRIPSI</label>
                    <input value="" type="text" name="deskripsi" id="deskripsi" class="form-control" required>
                    <small id="error-deskripsi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>TAHUN</label>
                    <select name="tahun_id" id="tahun_id" class="form-control dropdown-toggle" data-bs-toggle="dropdown" required>
                        <option value="">Pilih Tahun</option>
                        @foreach($tahun as $t)
                            <option value="{{ $t->tahun_id }}">{{ $t->tahun }}</option>
                        @endforeach
                    </select>
                    <small id="error-tahun_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>DOSEN PIC</label>
                    <select name="user_id" id="user_id" class="form-control dropdown-toggle" data-bs-toggle="dropdown" required>
                        <option value="">Pilih Nama Dosen</option>
                        @foreach($user as $u)
                            <option value="{{ $u->user_id }}">{{ $u->nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-user_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>JENIS KEGIATAN</label>
                    <select name="kategori_kegiatan_id" id="kategori_kegiatan_id" class="form-control" required>
                        <option value="">Pilih Jenis</option>
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
                        <option value="Luar Institusi" {{ isset($kegiatannonjti) && $kegiatannonjti->cakupan_wilayah == 'Luar Institusi' ? 'selected' : '' }}>Luar Institusi</option>
                        <option value="Institusi" {{ isset($kegiatannonjti) && $kegiatannonjti->cakupan_wilayah == 'Institusi' ? 'selected' : '' }}>Institusi</option>
                        <option value="Jurusan" {{ isset($kegiatannonjti) && $kegiatannonjti->cakupan_wilayah == 'Jurusan' ? 'selected' : '' }}>Jurusan</option>
                        <option value="Program Studi" {{ isset($kegiatannonjti) && $kegiatannonjti->cakupan_wilayah == 'Program Studi' ? 'selected' : '' }}>Program Studi</option>
                    </select>
                    <small id="error-cakupan_wilayah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>DEADLINE KEGIATAN</label>
                    <input 
                        type="date" 
                        name="deadline" 
                        id="deadline" 
                        class="form-control" 
                        value="{{ isset($kegiatannonjti->deadline) ? \Carbon\Carbon::parse($kegiatannonjti->deadline)->format('Y-m-d') : '' }}" 
                        required>
                    <small id="error-deadline" class="error-text form-text text-danger"></small>
                </div>                
                <div class="form-group">
                    <label>WAKTU MULAI</label>
                    <input 
                        type="date" 
                        name="waktu_mulai" 
                        id="waktu_mulai" 
                        class="form-control" 
                        value="{{ isset($kegiatannonjti->waktu_mulai) ? \Carbon\Carbon::parse($kegiatannonjti->waktu_mulai)->format('Y-m-d') : '' }}">
                    <small id="error-waktu_mulai" class="error-text form-text text-danger"></small>
                </div>                
                <div class="form-group">
                    <label>WAKTU SELESAI</label>
                    <input 
                        type="date" 
                        name="waktu_selesai" 
                        id="waktu_selesai" 
                        class="form-control" 
                        value="{{ isset($kegiatannonjti->waktu_selesai) ? \Carbon\Carbon::parse($kegiatannonjti->waktu_selesai)->format('Y-m-d') : '' }}">
                    <small id="error-waktu_selesai" class="error-text form-text text-danger"></small>
                </div>                
                <div class="form-group">
                    <label>STATUS</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Pilih Status</option>
                        <option value="Belum Proses">Belum Proses</option>
                        <option value="Proses">Proses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                    <small id="error-status" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>BEBAN KERJA</label>
                    <select name="beban_kegiatan_id" id="beban_kegiatan_id" class="form-control" required>
                        <option value="">Pilih Beban Kerja</option>
                        @foreach($beban as $b)
                            <option value="{{ $b->beban_kegiatan_id }}">{{ $b->nama_beban }}</option>
                        @endforeach
                    </select>
                    <small id="error-beban_kegiatan_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>PROGRESS</label>
                    <input value="" type="text" name="progres" id="progres" class="form-control">
                    <small id="error-progres" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>KETERANGAN</label>
                    <input value="" type="text" name="keterangan" id="keterangan" class="form-control">
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
                    nama_kegiatan: { required: true, maxlength: 200 },
                    deskripsi: { required: true, maxlength: 255 },
                    tahun_id: { required: true, number: true },
                    user_id: { required: true, number: true },
                    kategori_kegiatan_id: { required: true, number: true },
                    cakupan_wilayah: { required: true },
                    deadline: { required: true, date: true },
                    waktu_mulai: { date: true },
                    waktu_selesai: { date: true },
                    status: { required: true },
                    beban_kegiatan_id: { required: true, number: true },
                    progres: { number: true },
                    keterangan: { maxlength: 255 }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataKegiatanNonJti.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
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
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>    
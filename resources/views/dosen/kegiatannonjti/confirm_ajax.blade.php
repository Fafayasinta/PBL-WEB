@empty($kegiatannonjti)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
    <form action="{{ url('/kegiatannonjti/' . $kegiatannonjti->kegiatan_id.'/delete_ajax') }}" method="POST" id="form-delete">
    @csrf
    @method('DELETE')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Jenis Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <h5><i class="icon fas fa-ban"></i> Konfirmasi !!!</h5>
                    Apakah Anda ingin menghapus data seperti di bawah ini?
                </div>
                <table class="table table-sm table-bordered table-striped">
                    <tr><th class="text-left col-3">Nama Kegiatan :</th><td class="col-9">{{$kegiatannonjti->nama_kegiatan }}</td></tr>
                    <tr><th class="text-left col-3">Nama Dosen :</th><td class="col-9">{{$kegiatannonjti->pic }}</td></tr>
                    <tr><th class="text-left col-3">Jenis :</th><td class="col-9">{{$kegiatannonjti->kategori->nama_kategori }}</td></tr>
                    <tr><th class="text-left col-3">Wilayah Kerja :</th><td class="col-9">{{$kegiatannonjti->cakupan_wilayah }}</td></tr>
                    <tr><th class="text-left col-3">Waktu :</th><td class="col-9">{{$kegiatannonjti->waktu_mulai }}</td></tr>
                    <tr><th class="text-left col-3">Beban :</th><td class="col-9">{{$kegiatannonjti->beban->nama_beban }}</td></tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Ya, Hapus</button>
            </div>
        </div>
    </div>
    </form>
    <script>
        $(document).ready(function() {
            $("#form-delete").validate({
                rules: {},
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
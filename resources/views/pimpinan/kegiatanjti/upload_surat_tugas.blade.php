@empty($surat)
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
    <form action="{{ url('/kegiatanjti/' . $surat->kegiatan_id. '/update_surat') }}" method="POST" id="form-edit" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">UPLOAD SURAT TUGAS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>   
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>UPLOAD SURAT TUGAS</label>
                    <div class="custom-file">
                        <input type="file" name="surat_tugas" id="surat_tugas" class="custom-file-input" accept=".pdf" required>
                        <label class="custom-file-label" for="surat_tugas">Pilih Surat Tugas</label>
                    </div>
                    <small id="error-surat_tugas" class="error-text form-text text-danger"></small>
                    <small class="form-text text-muted">Unggah surat tugas dalam format PDF. Maksimal 2MB.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Unggah</button>
            </div>
        </div>
    </div>
    </form>
    <script>
    $(document).ready(function () {
        $('#surat_tugas').on('change', function () {
            var file = this.files[0];
            if (file) {
                // Cek ukuran file
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimum 2MB.');
                    this.value = ''; // Reset file input
                    return;
                }
                // Ubah label input file dengan nama file
                $(this).next('.custom-file-label').html(file.name);
            }
        });

        $("#form-edit").validate({
            rules: {
                surat_tugas: {
                    required: false,
                    accept: "application/pdf" // Menerima hanya file PDF
                }
            },
            messages: {
                surat_tugas: {
                    required: "Unggah file surat tugas.",
                    accept: "Harap unggah file dengan format PDF."
                }
            },
            submitHandler: function(form) {
                        var formData = new FormData(
                            form);
                        $.ajax({
                            url: form.action,
                            type: form.method,
                            data: formData,
                            processData: false, // setting processData dan contentType ke false, untuk menghandle file 
                            contentType: false,
                            success: function(response) {
                                if (response.status) {
                                    $('#myModal').modal('hide');
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message
                                    }).then(() => {
                                // Refresh halaman atau arahkan ke URL yang dituju
                                        window.location.href = '/kegiatanjti'; // Ganti dengan URL tujuan jika berbeda
                                    });
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
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>   
@endif 
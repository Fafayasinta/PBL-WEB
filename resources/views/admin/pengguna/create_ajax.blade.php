<form action="{{ url('/pengguna/ajax') }}" method="POST" id="form-tambah" enctype="multipart/form-data">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Jenis Pengguna</label>
                    <select class="form-control" id="level_id" name="level_id" required>
                        <option value="">Pilih Jenis User</option>
                        <option value="1" {{ old('level_id') == 1 ? 'selected' : '' }}>Administrator</option>
                        <option value="2" {{ old('level_id') == 2 ? 'selected' : '' }}>Pimpinan</option>
                        <option value="3" {{ old('level_id') == 3 ? 'selected' : '' }}>Dosen</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input value="" type="text" name="username" id="username" class="form-control" required>
                    <small id="error-username" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input value="" type="text" name="password" id="password" class="form-control" required>
                    <small id="error-password" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input value="" type="text" name="nama" id="nama" class="form-control" required>
                    <small id="error-nama" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input value="" type="text" name="nip" id="nip" class="form-control" required>
                    <small id="error-nip" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input value="" type="text" name="email" id="email" class="form-control" required>
                    <small id="error-email" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Upload Foto Profil</label>
                    <div class="custom-file">
                        <input type="file" name="foto_profil" id="foto_profil" class="custom-file-input" accept="image/*" required>
                        <label class="custom-file-label" for="foto_profil">Pilih Foto</label>
                    </div>
                    <small id="error-foto_profil" class="error-text form-text text-danger"></small>
                    <small class="form-text text-muted">Unggah foto profil dalam format JPG, JPEG, atau PNG. Maksimal 2MB.</small>
                    <!-- Preview Image -->
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
        // Menampilkan preview gambar setelah memilih file
        $('#foto_profil').on('change', function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                    $('#preview-container').show(); // Menampilkan preview gambar
                }
                reader.readAsDataURL(file);

                // Mengubah label menjadi nama file yang dipilih
                var fileName = file.name;
                $(this).next('.custom-file-label').html(fileName);
            }
        });

        // Validasi form
        $("#form-tambah").validate({
            rules: {
                level_id: { required: true },
                username: { required: true, minlength: 3 },
                password: { required: true, minlength: 5 },
                nama: { required: true, maxlength: 100 },
                nip: { required: true, maxlength: 50 },
                email: { required: true },
                foto_profil: {
                    required: false, // Tidak wajib
                    accept: "image/*" // Hanya menerima file gambar
                }
            },
            messages: {
                foto_profil: {
                    accept: "Harap unggah file dengan format gambar (JPG, JPEG, PNG)."
                }
            },
            submitHandler: function(form) {
                // Gunakan FormData untuk mengirim data termasuk file
                let formData = new FormData(form);

                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: formData,
                    processData: false,
                    contentType: false, // Pastikan contentType dinonaktifkan untuk pengiriman file
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataPengguna.ajax.reload();
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
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal mengirim data ke server. Silakan coba lagi.'
                        });
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

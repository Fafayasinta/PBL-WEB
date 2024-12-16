@empty($profile)
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
                <a href="{{ url('/profile') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/profile/' . $profile->user_id.'/update_ajax') }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>   
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>ROLE</label>
                    <select name="level_id" id="level_id" class="form-control" required>
                        <option value="">Pilih Role</option>
                        @foreach($level as $l)
                            <option value="{{ $l->level_id }}" {{ $profile->level_id == $l->level_id ? 'selected' : '' }}>
                                {{ $l->level_nama }}
                            </option>
                        @endforeach
                    </select>
                    <small id="error-level_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>NAMA</label>
                    <input value="{{ $profile->nama }}" type="text" name="nama" id="nama" class="form-control" required>
                    <small id="error-nama" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>USERNAME</label>
                    <input value="{{ $profile->username }}" type="text" name="username" id="username" class="form-control" required>
                    <small id="error-username" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <input value="" type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Baru">
                    <small id="error-password" class="error-text form-text text-danger"></small>
                </div>  
                <div class="form-group">
                    <label>EMAIL</label>
                    <input value="{{ $profile->email }}" type="text" name="email" id="email" class="form-control" required>
                    <small id="error-email" class="error-text form-text text-danger"></small>
                </div>              
                <div class="form-group">
                    <label>NIP</label>
                    <input value="{{ $profile->nip }}" type="text" name="nip" id="nip" class="form-control" required>
                    <small id="error-nip" class="error-text form-text text-danger"></small>
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
                // Aturan validasi
                rules: {
                    level_id: { required: true, number: true },
                    nama: { required: true, minlength: 3, maxlength: 100 },
                    username: { required: true, minlength: 5, maxlength: 50 },
                    password: { minlength: 6 }, // Password tidak wajib tapi harus minimal 6 karakter jika diisi
                    email: { required: true, email: true },
                    nip: { required: true },
                },
                // Submit handler untuk proses AJAX
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action, // URL dari action form
                        type: form.method, // Method HTTP (POST/PUT)
                        data: $(form).serialize(), // Data form yang akan dikirimkan
                        success: function(response) {
                            if (response.status) {
                                // Jika berhasil, sembunyikan modal dan tampilkan pesan sukses
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                }).then(() => {
                                    // Refresh halaman atau arahkan ke URL tertentu
                                    window.location.href = '/profile'; // Ganti dengan URL tujuan
                                });
                            } else {
                                // Jika gagal, tampilkan pesan error di form
                                $('.error-text').text(''); // Bersihkan pesan error sebelumnya
                                if (response.errors) {
                                    // Jika ada validasi field yang gagal
                                    $.each(response.errors, function(prefix, val) {
                                        $('#error-' + prefix).text(val[0]); // Menampilkan error untuk setiap field
                                    });
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message || 'Data tidak valid. Silakan cek input Anda.'
                                });
                            }
                        },
                        error: function(xhr) {
                            // Error dari server (misalnya 500 atau 422)
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan Server',
                                text: xhr.responseJSON?.message || 'Terjadi kesalahan. Silakan coba lagi.',
                            });
                        }
                    });
                    return false; // Mencegah form dari submit normal
                },
                // Konfigurasi error element
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                // Highlight dan unhighlight input
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    
@endempty
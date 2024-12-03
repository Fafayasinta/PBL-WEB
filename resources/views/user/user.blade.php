@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manajemen Pengguna</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr id="user-row-{{ $user->user_id }}">
                                <td>
                                    <img src="{{ Storage::url($user->foto_profil) }}" 
                                         alt="Foto Profil"
                                         class="img-circle"
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>
                                    <span id="nama-{{ $user->user_id }}">{{ $user->nama }}</span>
                                    <input type="text" 
                                           class="form-control d-none edit-input" 
                                           id="edit-nama-{{ $user->user_id }}"
                                           value="{{ $user->nama }}">
                                </td>
                                <td>
                                    <span id="nip-{{ $user->user_id }}">{{ $user->nip }}</span>
                                    <input type="text" 
                                           class="form-control d-none edit-input" 
                                           id="edit-nip-{{ $user->user_id }}"
                                           value="{{ $user->nip }}">
                                </td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info edit-btn" 
                                            data-user-id="{{ $user->user_id }}"
                                            onclick="toggleEdit({{ $user->user_id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success save-btn d-none" 
                                            data-user-id="{{ $user->user_id }}"
                                            onclick="saveChanges({{ $user->user_id }})">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger"
                                            onclick="deleteUser({{ $user->user_id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
function toggleEdit(userId) {
    // Toggle tampilan input dan text
    $(`#nama-${userId}, #nip-${userId}`).toggleClass('d-none');
    $(`#edit-nama-${userId}, #edit-nip-${userId}`).toggleClass('d-none');
    
    // Toggle tombol edit dan save
    $(`tr#user-row-${userId} .edit-btn, tr#user-row-${userId} .save-btn`).toggleClass('d-none');
}

function saveChanges(userId) {
    const nama = $(`#edit-nama-${userId}`).val();
    const nip = $(`#edit-nip-${userId}`).val();

    $.ajax({
        url: `/user/${userId}`,
        type: 'PUT',
        data: {
            nama: nama,
            nip: nip,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if(response.success) {
                // Update tampilan
                $(`#nama-${userId}`).text(nama);
                $(`#nip-${userId}`).text(nip);
                
                // Kembalikan ke mode view
                toggleEdit(userId);
                
                // Tampilkan notifikasi
                toastr.success(response.message);
            }
        },
        error: function(xhr) {
            toastr.error('Terjadi kesalahan saat menyimpan perubahan');
        }
    });
}

function deleteUser(userId) {
    if(confirm('Apakah Anda yakin ingin menghapus user ini?')) {
        $.ajax({
            url: `/user/${userId}`,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.success) {
                    // Hapus baris dari tabel
                    $(`#user-row-${userId}`).remove();
                    toastr.success(response.message);
                }
            },
            error: function(xhr) {
                toastr.error('Terjadi kesalahan saat menghapus user');
            }
        });
    }
}
</script>
@endpush
@endsection
@extends('admin.layouts.template')

<style>
    .card-header {
        background-color: #fff;
        border-bottom: none;
    }

    .card-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: bold;
    }

    button[type="submit"] {
        background-color: #ff5722;
        border-color: #ff5722;
        color: #fff;
    }

    button[type="submit"]:hover {
        background-color: #e64a19;
        border-color: #e64a19;
    }
</style>

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Profile</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/profile/' . Auth::user()->user_id . '/update') }}" enctype="multipart/form-data" id="form-edit-profile">
                @csrf
                @method('PUT') <!-- Pastikan menggunakan method PUT untuk mengupdate data -->

                <div class="row mb-4">
                    <!-- Foto Profil -->
                    <div class="col-md-3 text-center">
                        <img src="{{ asset('storage/' . (Auth::user()->foto_profil ?? 'default-profile.jpg')) }}" 
                             alt="Profile Picture" 
                             class="rounded-circle mb-3" 
                             style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="mt-2">
                            <label for="foto_profil" class="btn btn-outline-secondary btn-sm" id="foto-label">
                                Upload Foto
                            </label>
                            <input type="file" id="foto_profil" name="foto_profil" class="d-none" accept="image/*">
                        </div>
                    </div>

                    <!-- Input Fields -->
                    <div class="col-md-9">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="{{ old('name', Auth::user()->nama) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" 
                                       value="{{ old('username', Auth::user()->username) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ old('email', Auth::user()->email) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Masukkan Password Baru">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" 
                                       value="{{ old('nip', Auth::user()->nip) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control" id="role" name="role" 
                                       value="{{ old('role', Auth::user()->level->level_kode ?? 'N/A') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary d-flex align-items-center">
                        <i class="nav-icon fas fa-save me-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

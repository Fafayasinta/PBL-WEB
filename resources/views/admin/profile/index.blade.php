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
            <h5 class="mb-0">Profile Pengguna</h5>
        </div>
        <div class="card-body">
                <div class="row mb-4">
                    <!-- Foto Profil -->
                    <div class="col-md-3 text-center">
                        <img src="{{ asset($profile->foto_profil) }}" 
                             alt="Profile Picture" 
                             class="rounded-circle mb-3" 
                             style="width: 160px; height: 160px; obje   ct-fit: cover;">
                        <div class="d-flex justify-content-center">
                            <button onclick="modalAction('{{ url('/profile/' . $profile->user_id . '/edit_foto') }}')" class="btn btn-primary d-flex align-items-center">
                                Edit Foto
                            </button>
                        </div>
                    </div>

                    <!-- Input Fields -->
                    <div class="col-md-9">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama</label>
                                <div class="form-control" style="border: 1px solid #ced4da; height: 38px; display: flex; align-items: center;">
                                    {{ $profile->nama }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <div class="form-control" style="border: 1px solid #ced4da; height: 38px; display: flex; align-items: center;">
                                    {{ $profile->username }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <div class="form-control" style="border: 1px solid #ced4da; height: 38px; display: flex; align-items: center;">
                                    {{ $profile->email }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <div class="form-control" style="border: 1px solid #ced4da; height: 38px; display: flex; align-items: center;">
                                    ********
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nip" class="form-label">NIP</label>
                                <div class="form-control" style="border: 1px solid #ced4da; height: 38px; display: flex; align-items: center;">
                                    {{ $profile->nip }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <div class="form-control" style="border: 1px solid #ced4da; height: 38px; display: flex; align-items: center;">
                                    {{ $profile->level->level_nama }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary d-flex align-items-center" onclick="modalAction('{{ url('/profile/' . $profile->user_id . '/edit_ajax') }}')">
                        <i class="nav-icon fas fa-save me-2" style="margin-right: 5px"></i>
                        <span>Edit Profile</span>
                    </button>
                </div>                             
            </form>
        </div>
    </div>
</div>

@endsection

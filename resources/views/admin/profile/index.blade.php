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
            {{-- <form method="POST" action="{{ route('profile.update') }}"> --}}
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <!-- Foto Profil -->
                    <div class="col-md-3 text-center">
                        {{-- <img src="{{ asset('path/to/default/profile.jpg') }}" alt="Profile Picture" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;"> --}}
                        <button type="button" class="btn btn-outline-secondary btn-sm">
                            Edit
                        </button>
                    </div>

                    <!-- Input Fields -->
                    <div class="col-md-9">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Your Name</label>
                                {{-- <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"> --}}
                            </div>
                            <div class="col-md-6">
                                <label for="username" class="form-label">User Name</label>
                                {{-- <input type="text" class="form-control" id="username" name="username" value="{{ old('username', Auth::user()->username) }}"> --}}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                {{-- <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"> --}}
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                {{-- <input type="password" class="form-control" id="password" name="password" placeholder="********" disabled> --}}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nip" class="form-label">NIP</label>
                                {{-- <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', Auth::user()->nip) }}"> --}}
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role</label>
                                {{-- <input type="text" class="form-control" id="role" name="role" value="{{ old('role', Auth::user()->role) }}" disabled> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary d-flex align-items-center">
                        <i class="nav-icon fas fa-sd-card" style="margin-right: 10px"></i> <!-- Jarak menggunakan me-2 -->
                        Simpan Perubahan
                    </button>
                </div>                                               
            </form>
        </div>
    </div>
</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Your Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('User Name') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', Auth::user()->username) }}" required>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nip" class="col-md-4 col-form-label text-md-end">{{ __('NIP') }}</label>

                            <div class="col-md-6">
                                <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip', Auth::user()->nip) }}" required>

                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                                    <option value="Admin" {{ Auth::user()->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="User" {{ Auth::user()->role == 'User' ? 'selected' : '' }}>User</option>
                                </select>

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save Changes') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

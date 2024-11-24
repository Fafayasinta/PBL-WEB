@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white rounded-lg">
    <h2 class="text-xl font-medium text-red-500 mb-8">Edit Profile</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="flex gap-8 mb-8">
            <div class="relative">
                <img 
                    src="{{ Storage::url($user->foto_profil ?? 'default-profile.jpg') }}"
                    alt="Profile" 
                    class="w-32 h-32 rounded-full object-cover"
                />
                <label class="absolute bottom-0 right-0 bg-red-500 p-2 rounded-full cursor-pointer">
                    <input type="file" name="foto_profil" class="hidden" accept="image/*">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </label>
            </div>
            
            <div class="mt-4">
                <h3 class="text-xl font-medium">{{ $user->nama }}</h3>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block mb-2">Your Name</label>
                <input
                    type="text"
                    name="nama"
                    class="w-full p-2 border rounded @error('nama') border-red-500 @enderror"
                    value="{{ old('nama', $user->nama) }}"
                />
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2">User Name</label>
                <input
                    type="text"
                    name="username"  
                    class="w-full p-2 border rounded @error('username') border-red-500 @enderror"
                    value="{{ old('username', $user->username) }}"
                />
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2">Email</label>
                <input
                    type="email"
                    name="email"
                    class="w-full p-2 border rounded @error('email') border-red-500 @enderror"
                    value="{{ old('email', $user->email) }}"
                />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2">Password</label>
                <input
                    type="password"
                    name="password"
                    class="w-full p-2 border rounded @error('password') border-red-500 @enderror"
                    placeholder="Kosongkan jika tidak ingin mengubah password"
                />
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2">NIP</label>
                <input
                    type="text"
                    name="nip"
                    class="w-full p-2 border rounded @error('nip') border-red-500 @enderror"
                    value="{{ old('nip', $user->nip) }}"
                />
                @error('nip')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2">Role</label>
                <input
                    type="text"
                    class="w-full p-2 border rounded bg-gray-100"
                    value="{{ $user->role }}"
                    disabled
                />
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
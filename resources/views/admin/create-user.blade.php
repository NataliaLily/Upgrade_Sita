@extends('adminlte::page')

@section('title', 'Tambah Akun')

@section('content')
<div class="container mx-auto mt-12 max-w-lg">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Create New Account</h1>

    <div class="card shadow-xl rounded-2xl overflow-hidden border border-gray-300">
        <div class="card-body p-6">
            {{-- Ubah route ke admin.store-user --}}
            <form action="{{ route('admin.store-user') }}" method="POST">
                @csrf
                <!-- Nama -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Nama</label>
                    <input type="text" name="name" id="name" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-indigo-400" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" id="email" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-indigo-400" required>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" name="password" id="password" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-indigo-400" required>
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-indigo-400" required>
                </div>

                <!-- Role -->
                <div class="mb-6">
                    <label for="role" class="block text-gray-700 font-semibold mb-2">Role</label>
                    <select name="role" id="role" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-indigo-400" required>
                        <option value="" disabled selected>Pilih role</option>
                        <option value="dosen">Dosen</option>
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <!-- NIM (hanya untuk mahasiswa) -->
                <div class="form-group" id="nim-field" style="display:none; max-width:300px;">
                    <label for="no_mhs">NIM</label>
                    <input type="text" name="no_mhs" id="no_mhs" class="form-control">
                </div>

                <!-- Tombol -->
                <div class="form-group" style="max-width:150px;">
                    <button type="submit" class="btn btn-success btn-sm btn-block">
                        Tambah
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Script untuk menampilkan NIM kalau role = mahasiswa --}}
<script>
document.getElementById('role').addEventListener('change', function () {
    let nimField = document.getElementById('nim-field');
    nimField.style.display = this.value === 'mahasiswa' ? 'block' : 'none';
});
</script>
@endsection

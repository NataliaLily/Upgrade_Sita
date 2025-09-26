@extends('adminlte::page')

@section('title', 'Daftar Akun')

@section('content_header')
    <h1>Daftar Akun</h1>
@stop

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0"></h3>
        <a href="{{ route('admin.create-user') }}" class="btn btn-success btn-sm">
            <i class="fas fa-user-plus"></i> Tambah Akun
        </a>
    </div>

    @if(session('success'))
        <x-adminlte-alert theme="success" title="Sukses" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    <x-adminlte-card title="Tabel Akun" theme="dark" icon="fas fa-users" collapsible>
        <x-adminlte-datatable id="usersTable" :heads="['No','Nama','Email','Role','Aksi']" head-theme="" striped hoverable bordered>
            @forelse($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td class="text-center">
                        {{-- Tombol Ubah Password --}}
                        <x-adminlte-button 
                            label="Ubah Password" 
                            theme="warning" 
                            icon="fas fa-key"
                            data-bs-toggle="modal"
                            data-bs-target="#changePasswordModal"
                            data-userid="{{ $user->id }}"
                            data-username="{{ $user->name }}"
                            class="btn-sm me-1"/>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('admin.delete-user', $user->id) }}" 
                            method="POST" 
                            class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                            @csrf
                            @method('DELETE')
                            <x-adminlte-button label="Hapus" theme="danger" icon="fas fa-trash" class="btn-sm"/>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada akun</td>
                </tr>
            @endforelse
        </x-adminlte-datatable>
    </x-adminlte-card>

    {{-- Modal Ubah Password --}}
    <x-adminlte-modal id="changePasswordModal" title="Ubah Password" theme="success" icon="fas fa-key" size="md">
        <form id="changePasswordForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" id="modalUserId">
            <div class="mb-3">
                <x-adminlte-input name="username" label="Nama User" id="modalUserName" readonly/>
            </div>
            <div class="mb-3">
                <x-adminlte-input name="password" type="password" label="Password Baru" required/>
            </div>
            <div class="mb-3">
                <x-adminlte-input name="password_confirmation" type="password" label="Konfirmasi Password" required/>
            </div>
            <x-slot name="footerSlot">
                <x-adminlte-button theme="success" label="Simpan" type="submit"/>
                <x-adminlte-button theme="secondary" label="Batal" data-bs-dismiss="modal"/>
            </x-slot>
        </form>
    </x-adminlte-modal>
@stop

@section('js')
<script>
    var changePasswordModal = document.getElementById('changePasswordModal')
    changePasswordModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var userId = button.getAttribute('data-userid')
        var username = button.getAttribute('data-username')

        // isi modal
        document.getElementById('modalUserId').value = userId
        document.getElementById('modalUserName').value = username

        // update action form
        var form = document.getElementById('changePasswordForm')
        form.action = '/admin/users/' + userId + '/change-password'
    })
</script>
@stop

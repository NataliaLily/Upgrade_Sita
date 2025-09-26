@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <h3>Tabel Data Mahasiswa</h3>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Dosen Wali</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $mhs)
                                <tr>
                                    <td>{{ $mhs->no_mhs }}</td>
                                    <td>{{ $mhs->nama }}</td>
                                    <td>{{ $mhs->email_utama }}</td>
                                    <td>{{ $mhs->dosenWali ? $mhs->dosenWali->nama_dosen : '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $mahasiswas->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <h3>Tabel Data Dosen</h3>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. Dosen</th>
                                <th>Nama Dosen</th>
                                <th>NIDN</th>
                                <th>Jumlah Mahasiswa Wali</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosens as $dosen)
                                <tr>
                                    <td>{{ $dosen->no_dosen }}</td>
                                    <td>{{ $dosen->nama_dosen }}</td>
                                    <td>{{ $dosen->nidn }}</td>
                                    <td>{{ $dosen->mahasiswas->count() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $dosens->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop

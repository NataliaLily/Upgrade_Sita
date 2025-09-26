@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <h3>Tabel Data Tugas Akhir</h3>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('tugasakhir.add')}}" class="btn btn-primary">Tambah Tugas Akhir</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM Mahasiswa</th>
                                <th>Semester</th>
                                <th>Judul Skripsi</th>
                                <th>Dosen Pembimbing 1</th>
                                <th>Dosen Pembimbing 2</th>
                                <th>Jadwal Ujian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tugasAkhirs as $index => $ta)
                                <tr>
                                    <td>{{ $loop->iteration + ($tugasAkhirs->currentPage() - 1) * $tugasAkhirs->perPage() }}
                                    </td>
                                    <td>{{ $ta->mahasiswa ? $ta->mahasiswa->no_mhs : '-' }}</td>
                                    <td>{{ $ta->akdsem }}</td>
                                    <td>{{ $ta->judul_tugas_akhir }}</td>
                                    <td>{{ $ta->dosenPembimbing1 ? $ta->dosenPembimbing1->nama_dosen : '-' }}</td>
                                    <td>{{ $ta->dosenPembimbing2 ? $ta->dosenPembimbing2->nama_dosen : '-' }}</td>
                                    <td>{{ $ta->jadwal_ujian ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('tugasakhir.edit', $ta->id_tugas_akhir) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('tugasakhir.delete', $ta->id_tugas_akhir) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin hapus?')">Delete</button>
                                        </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $tugasAkhirs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

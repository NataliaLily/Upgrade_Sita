@extends('adminlte::page')

@section('title', 'Edit Tugas Akhir')

@section('content_header')
    <h1>Edit Tugas Akhir</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tugasakhir.update', $tugasAkhir->id_tugas_akhir) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="id_mhs">Mahasiswa</label>
                    <select name="id_mhs" class="form-control">
                        @foreach ($mahasiswas as $mhs)
                            <option value="{{ $mhs->id }}" {{ $tugasAkhir->id_mhs == $mhs->id ? 'selected' : '' }}>
                                {{ $mhs->no_mhs }} - {{ $mhs->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="akdsem">Semester</label>
                    <input type="text" name="akdsem" class="form-control" value="{{ $tugasAkhir->akdsem }}">
                </div>

                <div class="form-group">
                    <label for="judul_tugas_akhir">Judul Tugas Akhir</label>
                    <input type="text" name="judul_tugas_akhir" class="form-control"
                        value="{{ $tugasAkhir->judul_tugas_akhir }}">
                </div>

                <div class="form-group">
                    <label for="id_dosen_pembimbing_1">Dosen Pembimbing 1</label>
                    <select name="id_dosen_pembimbing_1" class="form-control">
                        @foreach ($dosens as $dosen)
                            <option value="{{ $dosen->id }}"
                                {{ $tugasAkhir->id_dosen_pembimbing_1 == $dosen->id ? 'selected' : '' }}>
                                {{ $dosen->nama_dosen }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_dosen_pembimbing_2">Dosen Pembimbing 2</label>
                    <select name="id_dosen_pembimbing_2" class="form-control">
                        <option value="">-</option>
                        @foreach ($dosens as $dosen)
                            <option value="{{ $dosen->id }}"
                                {{ $tugasAkhir->id_dosen_pembimbing_2 == $dosen->id ? 'selected' : '' }}>
                                {{ $dosen->nama_dosen }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="form-group">
                <label for="jadwal_ujian">Jadwal Ujian</label>
                <input type="date" name="jadwal_ujian" class="form-control" value="{{ $tugasAkhir->jadwal_ujian }}">
            </div> --}}

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('admin.tugasakhir.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@stop

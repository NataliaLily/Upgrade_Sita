@extends('adminlte::page')

@section('title', 'Edit Tugas Akhir')

@section('content_header')
    <h1>Edit Data Tugas Akhir</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('tugasakhir.update', $tugasAkhir->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="id_mhs">NIM Mahasiswa</label>
                            <select name="id_mhs" class="form-control" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach ($mahasiswas as $mhs)
                                    <option value="{{ $mhs->id }}" {{ $tugasAkhir->id_mhs == $mhs->id ? 'selected' : '' }}>
                                        {{ $mhs->no_mhs }} - {{ $mhs->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="judul_tugas_akhir">Judul Skripsi</label>
                            <input type="text" name="judul_tugas_akhir" class="form-control" required
                                   value="{{ $tugasAkhir->judul_tugas_akhir }}">
                        </div>

                        <div class="form-group">
                            <label for="akdsem">Semester</label>
                            <input type="text" name="akdsem" class="form-control" required
                                   placeholder="contoh: 20251" value="{{ $tugasAkhir->akdsem }}">
                        </div>

                        <div class="form-group">
                            <label for="id_dosen_pembimbing_1">Dosen Pembimbing 1</label>
                            <select name="id_dosen_pembimbing_1" class="form-control" required>
                                <option value="">-- Pilih Dosen --</option>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ $tugasAkhir->id_dosen_pembimbing_1 == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->nama_dosen }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_dosen_pembimbing_2">Dosen Pembimbing 2</label>
                            <select name="id_dosen_pembimbing_2" class="form-control">
                                <option value="">-- Pilih Dosen --</option>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ $tugasAkhir->id_dosen_pembimbing_2 == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->nama_dosen }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('tugasakhir.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

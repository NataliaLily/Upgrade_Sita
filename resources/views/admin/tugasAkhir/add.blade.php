@extends('adminlte::page')

@section('title', 'Tambah Tugas Akhir')

@section('content_header')
    <h1>Tambah Data Tugas Akhir</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('tugasakhir.store') }}" method="POST">
                        @csrf

                        <!-- Mahasiswa -->
                        <div class="form-group">
                            <label for="id_mhs">NIM Mahasiswa</label>
                            <select name="id_mhs" class="form-control" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach ($mahasiswas as $mhs)
                                    <option value="{{ $mhs->id }}">{{ $mhs->no_mhs }} - {{ $mhs->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Judul -->
                        <div class="form-group">
                            <label for="judul_tugas_akhir">Judul Skripsi</label>
                            <input type="text" name="judul_tugas_akhir" class="form-control" required>
                        </div>

                        <!-- Semester -->
                        <div class="form-group">
                            <label for="akdsem">Semester</label>
                            <input type="text" name="akdsem" class="form-control" required placeholder="contoh: 20251">
                        </div>

                        <!-- Dosen Pembimbing 1 -->
                        <div class="form-group">
                            <label for="id_dosen_pembimbing_1">Dosen Pembimbing 1</label>
                            <select name="id_dosen_pembimbing_1" class="form-control" required>
                                <option value="">-- Pilih Dosen --</option>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dosen Pembimbing 2 -->
                        <div class="form-group">
                            <label for="id_dosen_pembimbing_2">Dosen Pembimbing 2</label>
                            <select name="id_dosen_pembimbing_2" class="form-control">
                                <option value="">-- Pilih Dosen --</option>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jadwal Ujian -->
                        {{-- <div class="form-group">
                            @if ($tugasAkhirs->approve_doping_1_tugas_akhir == 1 && $tugasAkhirs->approve_doping_2_tugas_akhir == 1)
                                <span class="badge bg-success">
                                    {{ $tugasAkhirs->jadwal_ujian ?? 'Belum Dijadwalkan' }}
                                </span>
                            @else
                                <span class="badge bg-danger">Belum Approve Dosen</span>
                            @endif
                        </div> --}}

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.tugasakhir.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

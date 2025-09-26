<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;

class TugasAkhirController extends Controller
{
    public function index()
    {
        $tugasAkhirs = TugasAkhir::with(['mahasiswa', 'dosenPembimbing1', 'dosenPembimbing2'])
            ->paginate(5);

        return view('admin.tugasAkhir.index', compact('tugasAkhirs'));
    }
    public function add()
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        return view('admin.tugasakhir.add', compact('mahasiswas', 'dosens'));
    }

    // Simpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'id_mhs' => 'required|exists:mahasiswas,id',
            'judul_tugas_akhir' => 'required|string|max:230',
            'akdsem' => 'required|string|max:5',
            'id_dosen_pembimbing_1' => 'required|exists:dosens,id',
            'id_dosen_pembimbing_2' => 'nullable|exists:dosens,id',
            'jadwal_ujian' => 'nullable|date',
        ]);

        TugasAkhir::create([
            'id_mhs' => $request->id_mhs,
            'judul_tugas_akhir' => $request->judul_tugas_akhir,
            'akdsem' => $request->akdsem,
            'id_dosen_pembimbing_1' => $request->id_dosen_pembimbing_1,
            'id_dosen_pembimbing_2' => $request->id_dosen_pembimbing_2,
            'jadwal_ujian' => $request->jadwal_ujian,
        ]);

        return redirect()->route('admin.tugasakhir.index')->with('success', 'Data Tugas Akhir berhasil ditambahkan!');
    }

    public function edit($id_tugas_akhir)
    {
        $tugasAkhir = TugasAkhir::findOrFail($id_tugas_akhir);
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();

        return view('admin.tugasakhir.edit', compact('tugasAkhir', 'mahasiswas', 'dosens'));
    }

    public function update(Request $request, $id_tugas_akhir)
    {
        $request->validate([
            'id_mhs' => 'required|exists:mahasiswas,id',
            'judul_tugas_akhir' => 'required|string|max:230',
            'akdsem' => 'required|string|max:5',
            'id_dosen_pembimbing_1' => 'required|exists:dosens,id',
            'id_dosen_pembimbing_2' => 'nullable|exists:dosens,id',
        ]);

        $tugasAkhir = TugasAkhir::findOrFail($id_tugas_akhir);
        $tugasAkhir->update([
            'id_mhs' => $request->id_mhs,
            'judul_tugas_akhir' => $request->judul_tugas_akhir,
            'akdsem' => $request->akdsem,
            'id_dosen_pembimbing_1' => $request->id_dosen_pembimbing_1,
            'id_dosen_pembimbing_2' => $request->id_dosen_pembimbing_2,
            'jadwal_ujian' => $request->jadwal_ujian,
        ]);

        return redirect()
            ->route('admin.tugasakhir.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function delete($id_tugas_akhir)
    {
        $tugasAkhir = TugasAkhir::findOrFail($id_tugas_akhir);
        $tugasAkhir->delete();

        return redirect()
            ->route('admin.tugasakhir.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}

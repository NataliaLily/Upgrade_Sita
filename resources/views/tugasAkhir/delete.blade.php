<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TugasAkhir;
use App\Models\Mahasiswa;
use App\Models\Dosen;

class TugasAkhirController extends Controller
{
    public function edit($id)
    {
        $tugasAkhir = TugasAkhir::findOrFail($id);

        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();

        return view('tugasakhir.edit', compact('tugasAkhir', 'mahasiswas', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_mhs' => 'required|exists:mahasiswas,id',
            'judul_tugas_akhir' => 'required|string|max:255',
            'akdsem' => 'required|string|max:10',
            'id_dosen_pembimbing_1' => 'required|exists:dosens,id',
            'id_dosen_pembimbing_2' => 'nullable|exists:dosens,id',
        ]);

        $tugasAkhir = TugasAkhir::findOrFail($id);

        $tugasAkhir->update([
            'id_mhs' => $request->id_mhs,
            'judul_tugas_akhir' => $request->judul_tugas_akhir,
            'akdsem' => $request->akdsem,
            'id_dosen_pembimbing_1' => $request->id_dosen_pembimbing_1,
            'id_dosen_pembimbing_2' => $request->id_dosen_pembimbing_2,
        ]);

        return redirect()->route('tugasakhir.index')->with('success', 'Data Tugas Akhir berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $tugasAkhir = TugasAkhir::findOrFail($id);

        $tugasAkhir->delete();

        return redirect()->route('tugasakhir.index')->with('success', 'Data Tugas Akhir berhasil dihapus!');
    }
}

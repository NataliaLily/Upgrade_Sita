<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $mahasiswas = Mahasiswa::with('dosenWali')->paginate(5);
        $dosens = Dosen::with('mahasiswas')->paginate(5);

        return view('admin.dashboard', compact('mahasiswas', 'dosens'));
    }
}

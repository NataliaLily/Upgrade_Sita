<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function listUsers()
    {
        $users = User::whereIn('role', ['mahasiswa', 'dosen'])->get();
        return view('admin.list-users', compact('users'));
    }

    public function createUser()
    {
        return view('admin.create-user');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:dosen,mahasiswa,admin',
            'no_mhs'   => 'nullable|required_if:role,mahasiswa|unique:mahasiswas,no_mhs',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        if ($request->role === 'mahasiswa') {
            Mahasiswa::create([
                'id_user'     => $user->id,
                'no_mhs'      => $request->no_mhs,
                'nama'        => $request->name,
                'email_utama' => $request->email,
                'id_dosen_wali' => null,
            ]);
        }

        return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Akun berhasil dihapus.');
    }

    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Password berhasil diubah.');
    }
}


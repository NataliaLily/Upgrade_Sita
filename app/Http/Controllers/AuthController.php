<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username_user' => 'required',
            'password' => 'required',
        ]);

        #3 hal 1 cek admin, 2 cek dosen, 3 cek mhs
        // Cek di tabel admin
        $userSita = \App\Models\User::where('username_user', $request->username_user)->first();
        if (Auth::attempt([
            'username_user' => $request->username_user,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        // if ($userSita) {
        //     if (password_verify($request->password, $userSita->password_user)) {
        //         Auth::login($userSita);
        //         dd(Auth::user());
        //         dd(Auth::check());
        //         $request->session()->regenerate();
        //         return redirect()->route('dashboard');
        //     }
        // }

        // Cek di tabel dosen
        $userDosen = \App\Models\LoginDosen::checkAccount($request->username_user, $request->password);
        if ($userDosen) {
            Auth::guard('dosen')->login($userDosen);
            dd(Auth::user());
            $request->session()->regenerate();
            return redirect()->route('dosen.dashboard');
        }
        $userMahasiswa = \App\Models\LoginMhs::checkAccount($request->username_user, $request->password);
        if ($userMahasiswa) {
            Auth::login($userMahasiswa);
            $request->session()->regenerate();
            return redirect()->route('mahasiswa.dashboard');
        }


        // $user = \App\Models\User::where('username_user', $request->username_user)->first();

        // if (!$user) {
        //     return back()->withErrors(['username_user' => 'User tidak ditemukan']);
        // }

        // // Jika password sudah bcrypt → verifikasi pakai Hash::check
        // if (Hash::check($request->password, $user->password_user)) {
        //     Auth::login($user);
        //     return redirect()->route('dashboard');
        // }

        // // Jika password masih plain text → cek manual
        // if (Hash::check($request->password, $user->password_user)) {
        //     Auth::login($user);
        //     return redirect()->route('dashboard'); 
        // }
        // dd("TEST");
        return back()->withErrors(['password' => 'Password salah']);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

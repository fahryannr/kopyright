<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function autentic(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        // Cek kredensial dan login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        // Jika login gagal, redirect kembali ke halaman login dengan pesan kesalahan
        return redirect()->back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput();
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function create()
    {
        $role = Roles::select('id', 'name')->get();
        $akun = User::all();
        return view('tambahakun', ['tamakun' => $akun, 'role' => $role]);
    }

    public function ambil()
    {
        $role = Roles::select('id', 'name')->get();
        $akun = User::all();
        return view('tambahakun', ['tamakun' => $akun]);
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username', // Validasi unik
            'password' => 'required|string|min:2',
            'validasiPassword' => 'required|string|min:2|same:password',
            'role_id' => 'required|integer',
        ]);
    
        // Buat pengguna
        User::create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')), // Enkripsi password
            'role_id' => $request->input('role_id'),
        ]);
    
        return redirect('/tambahakun')->with('success', 'Akun berhasil dibuat.');
    }
    

    public function delete(Request $request, $id)
    {
        $kathap = User::findOrFail($id);
        $kathap->delete();
        session()->flash('success', 'Akun berhasil dihapus');
        return redirect('/tambahakun');
    }

}

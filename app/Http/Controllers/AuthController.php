<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    // 1. Sesuaikan validasi dengan nama name="username" di form login.blade.php
    $credentials = $request->validate([
        'username' => 'required|string', 
        'password' => 'required',
    ]);

    // 2. Karena di database kolomnya 'identity_number', kita petakan username ke sana
    $userCredentials = [
        'identity_number' => $request->username,
        'password' => $request->password,
    ];

    // 3. Gunakan $userCredentials untuk proses autentikasi
    if (Auth::attempt($userCredentials)) {
        $request->session()->regenerate();
        
        // Arahkan berdasarkan role
        return Auth::user()->role === 'admin' 
            ? redirect()->intended('admin/dashboard') 
            : redirect()->intended('user/dashboard');
    }

    // 4. Jika gagal, kembalikan error
    return back()->withErrors([
        'username' => 'NIM atau password salah.',
    ])->onlyInput('username');
}

    // --- FITUR REGISTER BARU ---
    public function showRegister()
    {
        return view('auth.register');
    }

   public function register(Request $request) 
{
    // 1. Validasi
    // Sesuaikan name="nama_lengkap" dan name="nim_nip" dengan input di blade Anda
    $request->validate([
        'name' => 'required', // Harus sesuai dengan name di input field
        'username' => 'required|unique:users,identity_number', 
        'password' => 'required|confirmed',
    ]);

    // 2. Simpan ke database
    // Pastikan kunci array (identity_number) SAMA dengan nama kolom di database Anda
    $user = User::create([
        'name' => $request->name, 
        'identity_number' => $request->username, // Gunakan nama kolom DB yang benar
        'password' => Hash::make($request->password),
        'role' => 'user', // Tambahkan role jika di tabel user ada kolom role
    ]);

    // 3. Login otomatis setelah akun dibuat
    Auth::login($user);

    // 4. Redirect ke dashboard user
    return redirect()->route('user.dashboard')->with('success', 'Akun berhasil dibuat!');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
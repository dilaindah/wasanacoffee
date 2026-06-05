<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // 1. Tampilkan Halaman Form Login Admin
    public function showLogin()
    {
        return view('admin.login');
    }

    // 2. Proses Pengecekan Login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari admin berdasarkan username
        $admin = Admin::where('username', $request->username)->first();

        // Cek apakah admin ada dan password-nya cocok
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Jika cocok, simpan data login ke session manual
            session(['admin_logged_in' => true, 'admin_id' => $admin->id_admin, 'admin_username' => $admin->username]);
            
            return redirect()->route('admin.dashboard');
        }

        // Jika salah, balikin ke halaman login dengan pesan eror
        return back()->withErrors(['error' => 'Username atau Password salah!']);
    }

    // 3. Proses Logout Admin
    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id', 'admin_username']);
        return redirect()->route('admin.login');
    }
}
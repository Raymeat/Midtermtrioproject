<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;

class UserController extends Controller
{

    public function logout(Request $request)
    {
        // Logout dari guard 'web' (user)
        Auth::logout();
        // Logout dari guard 'admin'
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('ok', 'Logout berhasil.');
    }

    public function register(Request $request)
    {
        // 1. Validasi data input DASAR (HAPUS UNIQUE DARI SINI)
        $data = $request->validate([
            'name' => ['required', 'string', 'max:16'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:16']
        ]);

        // 2. Enkripsi password
        $data['password'] = Hash::make($data['password']);

        // 3. Logika pemisah
        if (str_ends_with($data['email'], '@its.ac.id')) {

            $request->validate([
                'name' => [Rule::unique('admins', 'name')],
                'email' => [Rule::unique('admins', 'email')],
            ]);
            
            $admin = Admin::create($data);
            Auth::guard('admin')->login($admin);
            return redirect('/admin/dashboard')->with('ok', 'Selamat datang min!');

        } else {
            
            $request->validate([
                'name' => [Rule::unique('users', 'name')],
                'email' => [Rule::unique('users', 'email')],
            ]);
            
            // INI SOLUSI "STUCK DI REGISTER" LO
            $data['role'] = 'user'; 
            
            $user = User::create($data);
            Auth::login($user); 
            return redirect('/user/dashboard')->with('ok', 'Registrasi berhasil!');
        }
    }

    public function login(Request $request)
    {
        // 1. Validasi input form login
        $fields = $request->validate([
            'loginname' => ['required', 'string'],
            'loginpassword' => ['required', 'string']
        ]);

        // 2. Siapkan kredensial
        $credentialsEmail = [
            'email' => $fields['loginname'], 
            'password' => $fields['loginpassword']
        ];
        $credentialsName = [
            'name' => $fields['loginname'], 
            'password' => $fields['loginpassword']
        ];

        // 3. Coba login sebagai USER BIASA (guard 'web')
        if (Auth::attempt($credentialsEmail) || Auth::attempt($credentialsName)) {
            $request->session()->regenerate();
            return redirect('/user/dashboard')->with('ok', 'Login sukses!');
        }

        // 4. Coba login sebagai ADMIN (guard 'admin')
        if (Auth::guard('admin')->attempt($credentialsEmail) || Auth::guard('admin')->attempt($credentialsName)) {
            $request->session()->regenerate();
            return redirect('/admin/dashboard')->with('ok', 'Login sukses sebagai Admin!');
        }

        // 5. Gagal total
        return back()->withErrors(['loginname' => 'Username/Email atau password salah.']);
    }
    public function updateProfile(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'name' => 'required|string|max:255',
            // Pastikan email itu unik, kecuali email yang sudah dimiliki user saat ini
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
        ]);

        // 2. Ambil User yang Sedang Login
        $user = Auth::user();

        // 3. Update Data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save(); // Simpan ke Database

        // 4. Redirect dengan pesan sukses
        return redirect()->route('user.settings')->with('success', 'Profil lo udah berhasil diupdate, Cuk!');
    }
    public function updatePassword(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed', 
        ]);

        // 2. Ambil User yang Sedang Login
        $user = Auth::user();

        // 3. Cek apakah Password Lama Benar
        if (!Hash::check($request->current_password, $user->password)) {
            // Jika salah, redirect balik dengan error
            return back()->withErrors([
                'current_password' => 'Password lama lo salah, Bro!',
            ])->withInput();
        }

        // 4. Update Password Baru
        $user->password = Hash::make($request->new_password);
        $user->save(); // Simpan ke Database

        // 5. Redirect dengan pesan sukses
        return redirect()->route('user.settings')->with('success', 'Password lo udah berhasil diganti, Cuk!');
    }
}


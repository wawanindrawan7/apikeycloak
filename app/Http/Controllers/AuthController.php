<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Ambil inputan username dan password
        $username = $request->input('username');
        $password = $request->input('password');

        // Logika otentikasi dengan Keycloak di sini
        // Gunakan pustaka klien Keycloak untuk memvalidasi kredensial pengguna melalui Keycloak

        // Contoh logika otentikasi sederhana
        if ($username === 'admin' && $password === 'password') {
            // Jika otentikasi berhasil, Anda dapat menghasilkan token akses atau token lain yang digunakan untuk otentikasi selanjutnya.
            $token = 'your-access-token';

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
            ]);
        } else {
            // Jika otentikasi gagal
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function redirect()
    {
        return Socialite::driver('keycloak')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('keycloak')->user();

        // Lakukan tindakan yang sesuai dengan hasil autentikasi, misalnya menyimpan data pengguna ke dalam database

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
        ]);
    }
}

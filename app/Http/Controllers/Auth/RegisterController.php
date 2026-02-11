<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        // Check if 2 users already exist - if yes, disable registration
        if (User::count() >= 2) {
            return redirect()->route('login')
                ->with('error', 'Pendaftaran admin sudah ditutup. Maksimal 2 admin.');
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Double check - prevent registration if 2 users already exist
        if (User::count() >= 2) {
            return redirect()->route('login')
                ->with('error', 'Pendaftaran admin sudah ditutup. Maksimal 2 admin.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        // Auto login after registration
        auth()->login($user);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Admin berhasil didaftarkan. Selamat datang!');
    }
}

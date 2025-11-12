<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PsychologistProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

class PsychologistRegisterController extends Controller
{
    /**
     * Display psychologist registration form
     */
    public function create()
    {
        return view('auth.register-psychologist');
    }

    /**
     * Handle psychologist registration
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'specialization' => ['required', 'string', 'max:255'],
            'str_number' => ['required', 'string', 'max:255'],
            'bio' => ['required', 'string', 'max:1000'],
            'education' => ['nullable', 'string', 'max:500'],
            'experience_years' => ['nullable', 'integer', 'min:0'],
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'psikolog',
        ]);

        // Create psychologist profile
        PsychologistProfile::create([
            'user_id' => $user->id,
            'specialization' => $request->specialization,
            'str_number' => $request->str_number,
            'bio' => $request->bio,
            'education' => $request->education,
            'experience_years' => $request->experience_years,
            'is_verified' => false, // Admin needs to verify
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Akun Anda menunggu verifikasi admin.');
    }
}

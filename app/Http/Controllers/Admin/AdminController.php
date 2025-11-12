<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PsychologistProfile;
use App\Models\User;
use App\Models\JanjiTemu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        $unverifiedPsychologists = PsychologistProfile::with('user')
            ->where('is_verified', false)
            ->get();

        $stats = [
            'total_psychologists' => User::where('role', 'psikolog')->count(),
            'verified_psychologists' => PsychologistProfile::where('is_verified', true)->count(),
            'total_patients' => User::where('role', 'pasien')->count(),
            'total_appointments' => JanjiTemu::count(),
            'pending_appointments' => JanjiTemu::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('unverifiedPsychologists', 'stats'));
    }

    /**
     * Display all users
     */
    public function users()
    {
        $users = User::with('psychologistProfile')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display all psychologists
     */
    public function psychologists()
    {
        $psychologists = User::where('role', 'psikolog')
            ->with('psychologistProfile')
            ->latest()
            ->get();
        return view('admin.psychologists.index', compact('psychologists'));
    }

    /**
     * Display all patients
     */
    public function patients()
    {
        $patients = User::where('role', 'pasien')->latest()->get();
        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Display all appointments
     */
    public function appointments()
    {
        $appointments = JanjiTemu::with(['pasien', 'psikolog'])->latest()->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Verify a psychologist
     */
    public function verifyPsychologist($id)
    {
        $profile = PsychologistProfile::findOrFail($id);
        $profile->update(['is_verified' => true]);

        return redirect()->back()->with('success', 'Psikolog berhasil diverifikasi!');
    }

    /**
     * Unverify a psychologist
     */
    public function unverifyPsychologist($id)
    {
        $profile = PsychologistProfile::findOrFail($id);
        $profile->update(['is_verified' => false]);

        return redirect()->back()->with('success', 'Verifikasi psikolog berhasil dicabut!');
    }

    /**
     * Delete user
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        // Delete related data
        if ($user->role === 'psikolog') {
            $user->psychologistProfile()->delete();
            $user->jadwals()->delete();
        }
        
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }
}

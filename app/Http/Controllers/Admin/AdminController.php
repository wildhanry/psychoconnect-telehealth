<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PsychologistProfile;
use App\Models\User;
use Illuminate\Http\Request;

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
        ];

        return view('admin.dashboard', compact('unverifiedPsychologists', 'stats'));
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
}

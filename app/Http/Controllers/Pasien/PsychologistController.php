<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PsychologistProfile;
use Illuminate\Http\Request;

class PsychologistController extends Controller
{
    /**
     * Display list of verified psychologists
     */
    public function index()
    {
        $psychologists = User::where('role', 'psikolog')
            ->whereHas('psychologistProfile', function ($query) {
                $query->where('is_verified', true);
            })
            ->with('psychologistProfile')
            ->get();

        return view('pasien.psychologists.index', compact('psychologists'));
    }

    /**
     * Show psychologist detail with available schedules
     */
    public function show($id)
    {
        $psychologist = User::where('role', 'psikolog')
            ->whereHas('psychologistProfile', function ($query) {
                $query->where('is_verified', true);
            })
            ->with(['psychologistProfile', 'jadwals' => function ($query) {
                $query->where('is_available', true)
                    ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
                    ->orderBy('start_time');
            }])
            ->findOrFail($id);

        return view('pasien.psychologists.show', compact('psychologist'));
    }
}

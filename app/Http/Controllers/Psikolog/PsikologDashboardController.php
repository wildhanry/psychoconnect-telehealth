<?php

namespace App\Http\Controllers\Psikolog;

use App\Http\Controllers\Controller;
use App\Models\JanjiTemu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PsikologDashboardController extends Controller
{
    /**
     * Display psychologist dashboard with upcoming appointments
     */
    public function index()
    {
        $upcomingAppointments = JanjiTemu::with('pasien')
            ->where('psikolog_id', Auth::id())
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('schedule_date')
            ->orderBy('schedule_time')
            ->get();

        $stats = [
            'pending' => JanjiTemu::where('psikolog_id', Auth::id())->where('status', 'pending')->count(),
            'confirmed' => JanjiTemu::where('psikolog_id', Auth::id())->where('status', 'confirmed')->count(),
            'completed' => JanjiTemu::where('psikolog_id', Auth::id())->where('status', 'completed')->count(),
        ];

        return view('psikolog.dashboard', compact('upcomingAppointments', 'stats'));
    }
}

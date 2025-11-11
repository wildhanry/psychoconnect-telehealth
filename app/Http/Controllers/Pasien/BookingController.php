<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\JanjiTemu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Show booking form for a specific psychologist
     */
    public function create($psychologistId)
    {
        $psychologist = User::where('role', 'psikolog')
            ->whereHas('psychologistProfile', function ($query) {
                $query->where('is_verified', true);
            })
            ->with(['psychologistProfile', 'jadwals' => function ($query) {
                $query->where('is_available', true);
            }])
            ->findOrFail($psychologistId);

        return view('pasien.booking.create', compact('psychologist'));
    }

    /**
     * Store appointment booking
     */
    public function store(StoreAppointmentRequest $request)
    {
        JanjiTemu::create([
            'pasien_id' => Auth::id(),
            'psikolog_id' => $request->psikolog_id,
            'schedule_date' => $request->schedule_date,
            'schedule_time' => $request->schedule_time,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()->route('pasien.appointments.index')->with('success', 'Janji temu berhasil dibuat! Menunggu konfirmasi psikolog.');
    }

    /**
     * Show my appointments
     */
    public function myAppointments()
    {
        $appointments = JanjiTemu::with(['psikolog.psychologistProfile'])
            ->where('pasien_id', Auth::id())
            ->orderBy('schedule_date', 'desc')
            ->orderBy('schedule_time', 'desc')
            ->get();

        return view('pasien.appointments.index', compact('appointments'));
    }

    /**
     * Cancel appointment
     */
    public function cancel($id)
    {
        $appointment = JanjiTemu::findOrFail($id);

        // Ensure patient can only cancel their own appointments
        if ($appointment->pasien_id !== Auth::id()) {
            abort(403);
        }

        $appointment->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Janji temu berhasil dibatalkan!');
    }
}

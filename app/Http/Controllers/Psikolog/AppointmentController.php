<?php

namespace App\Http\Controllers\Psikolog;

use App\Http\Controllers\Controller;
use App\Models\JanjiTemu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Approve/confirm an appointment
     */
    public function approve($id)
    {
        $appointment = JanjiTemu::findOrFail($id);

        // Ensure psychologist can only approve their own appointments
        if ($appointment->psikolog_id !== Auth::id()) {
            abort(403);
        }

        $appointment->update(['status' => 'confirmed']);

        return redirect()->back()->with('success', 'Janji temu berhasil dikonfirmasi!');
    }

    /**
     * Reject/cancel an appointment
     */
    public function reject($id)
    {
        $appointment = JanjiTemu::findOrFail($id);

        // Ensure psychologist can only reject their own appointments
        if ($appointment->psikolog_id !== Auth::id()) {
            abort(403);
        }

        $appointment->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Janji temu berhasil dibatalkan!');
    }

    /**
     * Mark appointment as completed
     */
    public function complete($id)
    {
        $appointment = JanjiTemu::findOrFail($id);

        // Ensure psychologist can only complete their own appointments
        if ($appointment->psikolog_id !== Auth::id()) {
            abort(403);
        }

        $appointment->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Janji temu ditandai sebagai selesai!');
    }

    /**
     * Update meeting link
     */
    public function updateMeetingLink(Request $request, $id)
    {
        $appointment = JanjiTemu::findOrFail($id);

        // Ensure psychologist can only update their own appointments
        if ($appointment->psikolog_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'meeting_link' => 'required|url',
        ]);

        $appointment->update(['meeting_link' => $request->meeting_link]);

        return redirect()->back()->with('success', 'Link meeting berhasil diperbarui!');
    }
}

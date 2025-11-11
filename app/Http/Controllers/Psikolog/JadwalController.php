<?php

namespace App\Http\Controllers\Psikolog;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJadwalRequest;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwals = Jadwal::where('user_id', Auth::id())
            ->orderBy('start_time')
            ->get();

        return view('psikolog.jadwal.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('psikolog.jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJadwalRequest $request)
    {
        Jadwal::create([
            'user_id' => Auth::id(),
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_available' => $request->is_available ?? true,
        ]);

        return redirect()->route('psikolog.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        // Ensure psychologist can only edit their own schedule
        if ($jadwal->user_id !== Auth::id()) {
            abort(403);
        }

        return view('psikolog.jadwal.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreJadwalRequest $request, Jadwal $jadwal)
    {
        // Ensure psychologist can only update their own schedule
        if ($jadwal->user_id !== Auth::id()) {
            abort(403);
        }

        $jadwal->update($request->validated());

        return redirect()->route('psikolog.jadwal.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        // Ensure psychologist can only delete their own schedule
        if ($jadwal->user_id !== Auth::id()) {
            abort(403);
        }

        $jadwal->delete();

        return redirect()->route('psikolog.jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}

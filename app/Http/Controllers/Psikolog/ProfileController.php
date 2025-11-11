<?php

namespace App\Http\Controllers\Psikolog;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePsychologistProfileRequest;
use App\Models\PsychologistProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show profile setup/edit form
     */
    public function edit()
    {
        $profile = Auth::user()->psychologistProfile;
        return view('psikolog.profile.edit', compact('profile'));
    }

    /**
     * Store or update psychologist profile
     */
    public function update(StorePsychologistProfileRequest $request)
    {
        $user = Auth::user();
        
        $profileData = $request->validated();
        $profileData['user_id'] = $user->id;

        // Update or create profile
        PsychologistProfile::updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return redirect()->route('psikolog.profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}

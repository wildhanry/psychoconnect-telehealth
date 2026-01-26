<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class JournalController extends Controller
{
    /**
     * Display the journal input form and list of user's journals.
     */
    public function index()
    {
        $journals = Journal::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pasien.journals.index', compact('journals'));
    }

    /**
     * Store a new journal entry with AI mood analysis.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:10',
        ]);

        $journalData = [
            'user_id' => auth()->id(),
            'content' => $request->content,
            'mood_label' => 'Pending Analysis',
            'mood_score' => null,
            'confidence_score' => null,
        ];

        try {
            // Call the external Python AI Service
            $aiServiceUrl = env('https://www.pythonanywhere.com/user/wildhanry/webapps/#tab_id_wildhanry_pythonanywhere_com');
            
            if (!$aiServiceUrl) {
                throw new \Exception('AI_SERVICE_URL not configured in .env file');
            }
            
            $aiServiceUrl .= '/predict';
            
            $response = Http::timeout(10)->post($aiServiceUrl, [
                'text' => $request->content,
            ]);

            if ($response->successful()) {
                $aiResult = $response->json();
                
                // Parse AI response
                // Expected format: {"prediction_label": "...", "prediction_score": 1, "confidence": "75.5%"}
                $journalData['mood_label'] = $aiResult['prediction_label'] ?? 'Unknown';
                $journalData['mood_score'] = $aiResult['prediction_score'] ?? null;
                
                // Convert confidence percentage string to float (e.g., "75.5%" -> 75.5)
                if (isset($aiResult['confidence'])) {
                    $confidence = str_replace('%', '', $aiResult['confidence']);
                    $journalData['confidence_score'] = (float) $confidence;
                }
            } else {
                // API returned error status
                Log::warning('AI Service returned error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }
        } catch (\Exception $e) {
            // Log the error but continue to save the journal
            Log::error('Failed to analyze mood with AI Service', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id(),
            ]);
        }

        // Save the journal entry
        Journal::create($journalData);

        if ($journalData['mood_label'] === 'Pending Analysis') {
            return redirect()->route('pasien.journals.index')
                ->with('warning', 'Jurnal tersimpan! Analisis mood sementara tidak tersedia.');
        }

        return redirect()->route('pasien.journals.index')
            ->with('success', 'Jurnal berhasil dianalisis! Mood Anda telah terdeteksi.');
    }

    /**
     * Show the form for editing the specified journal.
     */
    public function edit($id)
    {
        $journal = Journal::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('pasien.journals.edit', compact('journal'));
    }

    /**
     * Update the specified journal in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|min:10',
        ]);

        $journal = Journal::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $journal->update([
            'content' => $request->content,
        ]);

        return redirect()->route('pasien.journals.index')
            ->with('success', 'Jurnal berhasil diperbarui!');
    }

    /**
     * Remove the specified journal from storage.
     */
    public function destroy($id)
    {
        $journal = Journal::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $journal->delete();

        return redirect()->route('pasien.journals.index')
            ->with('success', 'Jurnal berhasil dihapus!');
    }

    /**
     * Re-analyze the journal's mood using AI.
     */
    public function reanalyze($id)
    {
        $journal = Journal::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        try {
            $aiServiceUrl = env('AI_SERVICE_URL');
            
            if (!$aiServiceUrl) {
                throw new \Exception('AI_SERVICE_URL not configured in .env file');
            }
            
            $aiServiceUrl .= '/predict';
            
            $response = Http::timeout(10)->post($aiServiceUrl, [
                'text' => $journal->content,
            ]);

            if ($response->successful()) {
                $aiResult = $response->json();
                
                $journal->mood_label = $aiResult['prediction_label'] ?? 'Unknown';
                $journal->mood_score = $aiResult['prediction_score'] ?? null;
                
                if (isset($aiResult['confidence'])) {
                    $confidence = str_replace('%', '', $aiResult['confidence']);
                    $journal->confidence_score = (float) $confidence;
                }
                
                $journal->save();

                return redirect()->route('pasien.journals.index')
                    ->with('success', 'Analisis mood berhasil diperbarui!');
            } else {
                Log::warning('AI Service returned error during re-analysis', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                
                return redirect()->route('pasien.journals.index')
                    ->with('warning', 'Analisis mood gagal. Layanan AI sedang tidak tersedia.');
            }
        } catch (\Exception $e) {
            Log::error('Failed to re-analyze mood', [
                'error' => $e->getMessage(),
                'journal_id' => $id,
            ]);

            return redirect()->route('pasien.journals.index')
                ->with('warning', 'Analisis mood gagal. Terjadi kesalahan pada layanan AI.');
        }
    }
}

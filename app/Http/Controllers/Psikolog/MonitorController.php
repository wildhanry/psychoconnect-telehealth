<?php

namespace App\Http\Controllers\Psikolog;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use App\Models\User;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    /**
     * Display patient's journal monitoring dashboard.
     */
    public function monitor($userId)
    {
        // Fetch the patient user
        $patient = User::where('id', $userId)
            ->where('role', 'pasien')
            ->firstOrFail();

        // Fetch last 30 journal entries for this patient
        $journals = Journal::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(30)
            ->get();

        // Reverse for chronological order in chart (oldest to newest)
        $journalsForChart = $journals->reverse()->values();

        // Prepare data for Chart.js
        $chartLabels = [];
        $chartData = [];

        foreach ($journalsForChart as $journal) {
            $chartLabels[] = $journal->created_at->format('M d');
            // Convert mood_score: 0→0 (Positif), 2→0.5 (Netral), 1→1 (Negatif)
            if ($journal->mood_score === null) {
                $chartData[] = null;
            } elseif ($journal->mood_score === 2) {
                $chartData[] = 0.5; // Netral di tengah
            } else {
                $chartData[] = (float) $journal->mood_score;
            }
        }

        // Calculate statistics
        $totalJournals = $journals->count();
        $journalsWithMood = $journals->whereNotNull('mood_score');
        $negativeCount = $journalsWithMood->where('mood_score', 1)->count();
        $positiveCount = $journalsWithMood->where('mood_score', 0)->count();
        $neutralCount = $journalsWithMood->where('mood_score', 2)->count();
        
        $percentageNegative = $journalsWithMood->count() > 0 
            ? round(($negativeCount / $journalsWithMood->count()) * 100, 1)
            : 0;

        $percentagePositive = $journalsWithMood->count() > 0 
            ? round(($positiveCount / $journalsWithMood->count()) * 100, 1)
            : 0;

        $percentageNeutral = $journalsWithMood->count() > 0 
            ? round(($neutralCount / $journalsWithMood->count()) * 100, 1)
            : 0;

        return view('psikolog.monitor', compact(
            'patient',
            'journals',
            'chartLabels',
            'chartData',
            'totalJournals',
            'negativeCount',
            'positiveCount',
            'neutralCount',
            'percentageNegative',
            'percentagePositive',
            'percentageNeutral'
        ));
    }
}

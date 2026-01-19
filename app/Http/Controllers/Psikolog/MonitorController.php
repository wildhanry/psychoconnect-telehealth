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
            $chartData[] = $journal->mood_score ?? null; // null if pending
        }

        // Calculate statistics
        $totalJournals = $journals->count();
        $journalsWithMood = $journals->whereNotNull('mood_score');
        $negativeCount = $journalsWithMood->where('mood_score', 1)->count();
        $positiveCount = $journalsWithMood->where('mood_score', 0)->count();
        
        $percentageNegative = $journalsWithMood->count() > 0 
            ? round(($negativeCount / $journalsWithMood->count()) * 100, 1)
            : 0;

        $percentagePositive = $journalsWithMood->count() > 0 
            ? round(($positiveCount / $journalsWithMood->count()) * 100, 1)
            : 0;

        return view('psikolog.monitor', compact(
            'patient',
            'journals',
            'chartLabels',
            'chartData',
            'totalJournals',
            'negativeCount',
            'positiveCount',
            'percentageNegative',
            'percentagePositive'
        ));
    }
}

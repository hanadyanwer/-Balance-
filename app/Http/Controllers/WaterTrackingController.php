<?php

namespace App\Http\Controllers;

use App\Models\WaterTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WaterTrackingController extends Controller
{
    /**
     * Show water tracking page
     */
    public function index()
    {
        $user = Auth::user();
        $date = Carbon::today();

        // Get today's water tracking records
        $records = WaterTracking::where('user_id', $user->id)
            ->whereDate('date', $date)
            ->orderBy('time', 'asc')
            ->get();

        // Get daily stats
        $stats = WaterTracking::getDailyStats($user->id, $date);

        // Get weekly data for chart
        $weeklyData = $this->getWeeklyData($user->id);

        return view('water-tracking', compact('records', 'stats', 'weeklyData', 'date'));
    }

    /**
     * Store new water tracking record
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount_ml' => 'required|integer|min:50|max:1000',
            'time' => 'nullable|date_format:H:i',
            'notes' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        WaterTracking::create([
            'user_id' => $user->id,
            'date' => Carbon::today(),
            'amount_ml' => $validated['amount_ml'],
            'time' => $validated['time'] ?? Carbon::now()->format('H:i'),
            'notes' => $validated['notes'] ?? null,
        ]);

        if ($request->expectsJson()) {
            $stats = WaterTracking::getDailyStats($user->id);
            return response()->json([
                'success' => true,
                'message' => 'Water intake recorded successfully',
                'stats' => $stats,
            ]);
        }

        return back()->with('success', 'Water intake recorded successfully!');
    }

    /**
     * Delete water tracking record
     */
    public function destroy($id)
    {
        $record = WaterTracking::findOrFail($id);

        // Check ownership
        if ($record->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $record->delete();

        if (request()->expectsJson()) {
            $stats = WaterTracking::getDailyStats(Auth::id());
            return response()->json([
                'success' => true,
                'message' => 'Water intake deleted successfully',
                'stats' => $stats,
            ]);
        }

        return back()->with('success', 'Water intake deleted successfully!');
    }

    /**
     * Get API endpoint for daily stats
     */
    public function getStats(Request $request)
    {
        $user = Auth::user();
        $date = $request->query('date', Carbon::today());

        $stats = WaterTracking::getDailyStats($user->id, $date);

        return response()->json($stats);
    }

    /**
     * Get weekly data for charts
     */
    private function getWeeklyData($userId)
    {
        $weekData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $total = WaterTracking::getDailyTotal($userId, $date);

            $weekData[] = [
                'date' => $date->format('M d'),
                'total' => $total,
            ];
        }

        return $weekData;
    }
}

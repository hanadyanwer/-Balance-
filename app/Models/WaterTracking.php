<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WaterTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'amount_ml',
        'time',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
    ];

    /**
     * Get the user that owns this water tracking record
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get daily water intake total
     */
    public static function getDailyTotal($userId, $date = null)
    {
        if (!$date) {
            $date = Carbon::today();
        }

        return self::where('user_id', $userId)
            ->whereDate('date', $date)
            ->sum('amount_ml');
    }

    /**
     * Get weekly average
     */
    public static function getWeeklyAverage($userId)
    {
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $total = self::where('user_id', $userId)
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount_ml');

        return ceil($total / 7);
    }

    /**
     * Get daily stats
     */
    public static function getDailyStats($userId, $date = null)
    {
        if (!$date) {
            $date = Carbon::today();
        }

        $daily_total = self::getDailyTotal($userId, $date);
        $target = 2000; // 2 liters default
        $percentage = min(round(($daily_total / $target) * 100), 100);

        return [
            'total_ml' => $daily_total,
            'target_ml' => $target,
            'percentage' => $percentage,
            'remaining_ml' => max(0, $target - $daily_total),
            'is_completed' => $daily_total >= $target,
        ];
    }
}

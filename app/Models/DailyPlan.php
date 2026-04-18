<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_date',
        'breakfast_id',
        'lunch_id',
        'snack_id',
        'dinner_id',
        'workout_id',
        'tip_id',
    ];

    protected $casts = [
        'plan_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function breakfast()
    {
        return $this->belongsTo(Recipe::class, 'breakfast_id');
    }

    public function lunch()
    {
        return $this->belongsTo(Recipe::class, 'lunch_id');
    }

    public function snack()
    {
        return $this->belongsTo(Recipe::class, 'snack_id');
    }

    public function dinner()
    {
        return $this->belongsTo(Recipe::class, 'dinner_id');
    }

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function tip()
    {
        return $this->belongsTo(Tip::class);
    }
}

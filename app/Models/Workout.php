<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'duration',
        'difficulty',
        'calories_burned',
        'equipment',
        'instructions',
        'image',
        'video_url',
    ];

    public function dailyPlans()
    {
        return $this->hasMany(DailyPlan::class);
    }
}

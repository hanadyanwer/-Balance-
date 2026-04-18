<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'meal_type',
        'description',
        'ingredients',
        'instructions',
        'calories',
        'protein',
        'carbs',
        'fats',
        'nutrition_profile',
        'prep_time',
        'image',
    ];

    public function dailyPlansAsBreakfast()
    {
        return $this->hasMany(DailyPlan::class, 'breakfast_id');
    }

    public function dailyPlansAsLunch()
    {
        return $this->hasMany(DailyPlan::class, 'lunch_id');
    }

    public function dailyPlansAsSnack()
    {
        return $this->hasMany(DailyPlan::class, 'snack_id');
    }

    public function dailyPlansAsDinner()
    {
        return $this->hasMany(DailyPlan::class, 'dinner_id');
    }
}

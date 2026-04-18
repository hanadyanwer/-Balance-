<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'date_of_birth',
        'gender',
        'weight',
        'height',
        'age',
        'health_goal',
        'bmi',
        'profile_completed',
        'avatar',
        'cover_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'profile_completed' => 'boolean',
    ];

    /**
     * Calculate BMI (Body Mass Index)
     */
    public function calculateBMI()
    {
        if ($this->weight && $this->height) {
            $heightInMeters = $this->height / 100;
            return round($this->weight / ($heightInMeters * $heightInMeters), 2);
        }
        return null;
    }

    /**
     * Get BMI category in English
     */
    public function getBMICategory()
    {
        $bmi = $this->bmi ?? $this->calculateBMI();

        if (!$bmi) return null;

        if ($bmi < 18.5) return 'Underweight';
        if ($bmi < 25) return 'Normal';
        if ($bmi < 30) return 'Overweight';
        return 'Obese';
    }

    /**
     * Get goal in English
     */
    public function getGoalInArabic()
    {
        return match($this->health_goal) {
            'lose_weight' => 'Lose Weight',
            'gain_weight' => 'Gain Weight',
            'build_muscle' => 'Build Muscle',
            'maintain' => 'Maintain Weight',
            default => $this->health_goal
        };
    }
}

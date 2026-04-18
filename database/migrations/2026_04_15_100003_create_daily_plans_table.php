<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('plan_date');
            $table->foreignId('breakfast_id')->nullable()->constrained('recipes')->onDelete('set null');
            $table->foreignId('lunch_id')->nullable()->constrained('recipes')->onDelete('set null');
            $table->foreignId('snack_id')->nullable()->constrained('recipes')->onDelete('set null');
            $table->foreignId('dinner_id')->nullable()->constrained('recipes')->onDelete('set null');
            $table->foreignId('workout_id')->nullable()->constrained('workouts')->onDelete('set null');
            $table->foreignId('tip_id')->nullable()->constrained('tips')->onDelete('set null');
            $table->timestamps();

            // Ensure one plan per user per day
            $table->unique(['user_id', 'plan_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_plans');
    }
};

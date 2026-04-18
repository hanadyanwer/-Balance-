<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['cardio', 'strength', 'flexibility', 'balance', 'hiit']);
            $table->text('description')->nullable();
            $table->integer('duration')->nullable(); // in minutes
            $table->enum('difficulty', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->integer('calories_burned')->nullable();
            $table->text('equipment')->nullable();
            $table->text('instructions')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workouts');
    }
};

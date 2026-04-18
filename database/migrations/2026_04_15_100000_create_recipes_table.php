<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('meal_type', ['breakfast', 'lunch', 'snack', 'dinner']);
            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();
            $table->text('instructions')->nullable();
            $table->integer('calories')->nullable();
            $table->integer('protein')->nullable();
            $table->integer('carbs')->nullable();
            $table->integer('fats')->nullable();
            $table->integer('prep_time')->nullable(); // in minutes
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};

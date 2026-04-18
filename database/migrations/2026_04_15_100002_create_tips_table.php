<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tips', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->enum('category', ['nutrition', 'fitness', 'wellness', 'mental_health', 'sleep'])->default('wellness');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tips');
    }
};

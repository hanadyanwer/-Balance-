<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('age')->nullable()->after('date_of_birth'); // العمر
            $table->decimal('bmi', 5, 2)->nullable()->after('height'); // BMI محسوب تلقائياً
            $table->boolean('profile_completed')->default(false)->after('health_goal'); // هل أكمل الملف
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['age', 'bmi', 'profile_completed']);
        });
    }
};

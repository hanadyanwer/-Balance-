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
            $table->date('date_of_birth')->nullable()->after('email');
            $table->enum('gender', ['male', 'female'])->nullable()->after('date_of_birth');
            $table->decimal('weight', 5, 2)->nullable()->after('gender');
            $table->decimal('height', 5, 2)->nullable()->after('weight');
            $table->string('health_goal')->nullable()->after('height');
            $table->string('avatar')->nullable()->after('health_goal');
            $table->string('cover_photo')->nullable()->after('avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['date_of_birth', 'gender', 'weight', 'height', 'health_goal', 'avatar', 'cover_photo']);
        });
    }
};

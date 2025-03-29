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
        Schema::create('timeslots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->unique();
            $table->integer('interval'); // Study session duration in minutes
            $table->json('preferred_start_time'); // JSON to store multiple preferred start times
            $table->json('preferred_end_time'); // JSON to store multiple end times
            $table->json('working_days'); // JSON array of working days
            $table->json('compensation_days'); // JSON array of compensation days
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timeslots');
    }
};

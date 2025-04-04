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
        Schema::create('postponed_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('original_task_id')->constrained('tasks')->onDelete('cascade');
            $table->foreignId('goal_id')->constrained()->onDelete('cascade');
            $table->date('original_date');
            $table->time('original_start_time');
            $table->time('original_end_time');
            $table->date('new_date');
            $table->time('new_start_time');
            $table->time('new_end_time');
            $table->text('reason');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postponed_tasks');
    }
};

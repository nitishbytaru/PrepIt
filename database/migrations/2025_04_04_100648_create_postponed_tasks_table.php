<?php

use App\Enums\TaskStatus;
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

            // Add user_id after id
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->foreignId('original_task_id')->constrained('tasks')->onDelete('cascade');
            $table->foreignId('goal_id')->constrained()->onDelete('cascade');

            $table->date('original_date');
            $table->time('original_start_time');
            $table->time('original_end_time');

            $table->date('new_date');
            $table->time('new_start_time');
            $table->time('new_end_time');

            $table->text('reason');

            // Use ENUM values from TaskStatus
            $table->enum('status', array_column(TaskStatus::cases(), 'value'))->default(TaskStatus::Pending->value);

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

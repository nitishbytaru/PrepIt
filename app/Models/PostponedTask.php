<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostponedTask extends Model
{
    use HasFactory;

    protected $fillable = ['original_task_id', 'goal_id', 'original_date', 'original_start_time', 'original_end_time', 'new_date', 'new_start_time', 'new_end_time', 'reason', 'status'];

    public function originalTask(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'original_task_id');
    }

    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class);
    }
}

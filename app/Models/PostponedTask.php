<?php
namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostponedTask extends Model
{
    use HasFactory;

    protected $fillable = ['original_task_id', 'user_id', 'goal_id', 'original_date', 'original_start_time', 'original_end_time', 'new_date', 'new_start_time', 'new_end_time', 'reason', 'status'];

    public function originalTask(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'original_task_id');
    }

    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class);
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            TaskStatus::Complete => 'bg-emerald-500',
            TaskStatus::Pending => 'bg-amber-500',
            TaskStatus::Postpone => 'bg-indigo-500',
            default => 'bg-slate-500',
        };
    }
}

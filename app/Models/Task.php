<?php
namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['goal_id', 'user_id', 'title', 'description', 'planned_date', 'planned_start_time', 'planned_end_time', 'actual_start_time', 'actual_end_time', 'status'];

    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class);
    }

    protected $casts = [
        'status' => TaskStatus::class,
    ];

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

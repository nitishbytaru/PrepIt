<?php
namespace App\Models;

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
}

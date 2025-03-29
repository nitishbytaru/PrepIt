<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timeslot extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'interval', 'preferred_start_time', 'preferred_end_time', 'working_days', 'compensation_days'];

    protected $casts = [
        'preferred_start_time' => 'array',
        'preferred_end_time' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

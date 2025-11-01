<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Schedule extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'name',
        'frequency_type',
        'frequency_value',
        'is_active',
        'last_run_at',
        'next_run_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_run_at' => 'datetime',
        'next_run_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function calculateNextRun(): Carbon
    {
        $now = Carbon::now();
        
        return match($this->frequency_type) {
            'minutes' => $now->addMinutes($this->frequency_value),
            'hours' => $now->addHours($this->frequency_value),
            'days' => $now->addDays($this->frequency_value),
            'weeks' => $now->addWeeks($this->frequency_value),
            'months' => $now->addMonths($this->frequency_value),
            default => $now->addHour()
        };
    }

    public function shouldRun(): bool
    {
        return $this->is_active && 
               $this->next_run_at && 
               Carbon::now()->gte($this->next_run_at);
    }
}
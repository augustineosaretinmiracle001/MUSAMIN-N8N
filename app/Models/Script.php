<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Script extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'title',
        'niche',
        'content',
        'metadata'
    ];

    // Helper methods for metadata access
    public function getGenerationType()
    {
        return $this->metadata['generation_type'] ?? 'manual';
    }

    public function getStatus()
    {
        return $this->metadata['status'] ?? 'pending';
    }

    public function getWordCount()
    {
        return $this->metadata['word_count'] ?? null;
    }

    public function getEstimatedDuration()
    {
        return $this->metadata['estimated_duration'] ?? null;
    }

    protected $casts = [
        'metadata' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPreference extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    // Helper methods for metadata access
    public function getNiche()
    {
        return $this->metadata['niche'] ?? null;
    }

    public function getInstructions()
    {
        return $this->metadata['instructions'] ?? null;
    }

    public function getAutoGenerateTitle()
    {
        return $this->metadata['auto_generate_title'] ?? true;
    }

    public function getTitle()
    {
        return $this->metadata['title'] ?? null;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
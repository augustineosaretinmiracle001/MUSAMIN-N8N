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
        'content',
        'content_niche',
        'script_status',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
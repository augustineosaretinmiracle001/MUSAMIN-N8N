<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Workflow extends Model
{
    use HasUuids;
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'workflow_data',
        'n8n_workflow_id',
        'status',
        'execution_history'
    ];

    protected $casts = [
        'workflow_data' => 'array',
        'execution_history' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
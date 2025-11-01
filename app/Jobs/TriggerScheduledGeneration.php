<?php

namespace App\Jobs;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TriggerScheduledGeneration implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Schedule $schedule
    ) {}

    public function handle(): void
    {
        try {
            $user = $this->schedule->user;
            $preferences = $user->preferences;

            // Prepare data for n8n
            $data = [
                'user_uuid' => $user->id,
                'type' => 'auto_generated', // Mark as automated
                'topic' => null, // Auto generation uses preferences
                'instructions' => $preferences?->custom_instructions ?? 'Be relatable to humans',
                'triggered_at' => now()->toISOString(),
                'schedule_id' => $this->schedule->id,
                'schedule_name' => $this->schedule->name,
                'preferences' => [
                    'niche' => $preferences?->niche ?? 'general',
                    'tone' => $preferences?->tone ?? 'neutral',
                    'style' => $preferences?->style ?? 'standard',
                    'target_audience' => $preferences?->target_audience ?? 'general audience',
                    'custom_instructions' => $preferences?->custom_instructions ?? 'Be relatable to humans'
                ]
            ];

            // Trigger n8n webhook
            $response = Http::timeout(30)->post('https://n8n.musamin.app/webhook/trigger-generation', $data);

            if ($response->successful()) {
                Log::info("Scheduled generation triggered successfully", [
                    'user_id' => $user->id,
                    'schedule_id' => $this->schedule->id
                ]);
            } else {
                Log::error("Failed to trigger scheduled generation", [
                    'user_id' => $user->id,
                    'schedule_id' => $this->schedule->id,
                    'response' => $response->body()
                ]);
            }

            // Update schedule timing
            $this->schedule->update([
                'last_run_at' => now(),
                'next_run_at' => $this->schedule->calculateNextRun()
            ]);

        } catch (\Exception $e) {
            Log::error("Scheduled generation job failed", [
                'schedule_id' => $this->schedule->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}
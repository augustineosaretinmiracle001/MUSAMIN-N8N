<?php

namespace App\Console\Commands;

use App\Jobs\TriggerScheduledGeneration;
use App\Models\Schedule;
use Illuminate\Console\Command;

class CheckSchedules extends Command
{
    protected $signature = 'schedules:check';
    protected $description = 'Check and trigger due scheduled script generations';

    public function handle()
    {
        $dueSchedules = Schedule::where('is_active', true)
            ->whereNotNull('next_run_at')
            ->where('next_run_at', '<=', now())
            ->with('user')
            ->get();

        $this->info("Found {$dueSchedules->count()} due schedules");

        foreach ($dueSchedules as $schedule) {
            $this->info("Triggering schedule: {$schedule->name} for user: {$schedule->user->name}");
            
            // Dispatch job to queue
            TriggerScheduledGeneration::dispatch($schedule);
        }

        $this->info('Schedule check completed');
    }
}
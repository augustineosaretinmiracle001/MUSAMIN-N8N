<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ScheduleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'frequency_type' => 'required|in:minutes,hours,days,weeks,months',
            'frequency_value' => 'required|integer|min:1'
        ]);

        $schedule = Schedule::create([
            'id' => Str::uuid(),
            'user_id' => auth()->id(),
            'name' => $request->name,
            'frequency_type' => $request->frequency_type,
            'frequency_value' => $request->frequency_value,
            'is_active' => true,
            'next_run_at' => now()->add($request->frequency_value, $request->frequency_type)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Schedule created successfully',
            'schedule' => $schedule
        ]);
    }

    public function update(Request $request, Schedule $schedule)
    {
        if ($schedule->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'is_active' => 'required|boolean'
        ]);

        $schedule->update([
            'is_active' => $request->is_active,
            'next_run_at' => $request->is_active 
                ? $schedule->calculateNextRun() 
                : null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Schedule updated successfully'
        ]);
    }

    public function destroy(Schedule $schedule)
    {
        if ($schedule->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $schedule->delete();

        return response()->json([
            'success' => true,
            'message' => 'Schedule deleted successfully'
        ]);
    }
}
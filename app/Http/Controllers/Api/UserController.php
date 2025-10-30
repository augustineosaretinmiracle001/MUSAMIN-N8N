<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Get user preferences for script generation
     * n8n calls this endpoint
     */
    public function getPreferences(string $user_uuid): JsonResponse
    {
        $user = User::with('preferences')->find($user_uuid);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $preferences = $user->preferences;
        
        if (!$preferences) {
            // Return default preferences if none exist
            return response()->json([
                'niche' => 'general',
                'tone' => 'neutral',
                'style' => 'standard',
                'target_audience' => null,
                'custom_instructions' => null,
                'user_id' => $user->id,
                'name' => $user->name
            ]);
        }

        return response()->json([
            'niche' => $preferences->niche,
            'tone' => $preferences->tone,
            'style' => $preferences->style,
            'target_audience' => $preferences->target_audience,
            'custom_instructions' => $preferences->custom_instructions,
            'user_id' => $user->id,
            'name' => $user->name
        ]);
    }
}
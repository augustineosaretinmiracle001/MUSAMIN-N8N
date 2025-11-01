<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function preferences()
    {
        return view('settings.preferences');
    }

    public function api()
    {
        return view('settings.api');
    }

    public function schedules()
    {
        return view('settings.schedules');
    }

    public function account()
    {
        return view('settings.account');
    }

    public function updatePreferences(Request $request)
    {
        $validated = $request->validate([
            'content_niche' => 'nullable|string|max:255',
            'writing_tone' => 'nullable|string|max:255',
            'writing_style' => 'nullable|string|max:255',
            'target_audience' => 'nullable|string|max:255',
            'custom_instructions' => 'nullable|string'
        ]);

        $user = Auth::user();
        
        UserPreference::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->route('settings.preferences')->with('success', 'Preferences updated successfully!');
    }

    public function generateToken(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);
        
        $user = Auth::user();
        
        // Create new token with custom name
        $token = $user->createToken($validated['name'])->plainTextToken;
        
        return response()->json(['token' => $token]);
    }
    
    public function deleteToken($tokenId)
    {
        $user = Auth::user();
        
        $token = $user->tokens()->where('id', $tokenId)->first();
        
        if (!$token) {
            return response()->json(['error' => 'Token not found'], 404);
        }
        
        $token->delete();
        
        return response()->json(['message' => 'Token deleted successfully']);
    }
}
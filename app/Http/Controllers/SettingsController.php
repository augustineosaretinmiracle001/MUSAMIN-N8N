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

    public function updatePreferences(Request $request)
    {
        $validated = $request->validate([
            'niche' => 'required|string|max:255',
            'tone' => 'required|string|max:255',
            'style' => 'required|string|max:255',
            'target_audience' => 'nullable|string|max:255',
            'custom_instructions' => 'nullable|string'
        ]);

        $user = Auth::user();
        
        UserPreference::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->route('settings')->with('success', 'Preferences updated successfully!');
    }

    public function generateToken()
    {
        $user = Auth::user();
        
        // Revoke existing tokens
        $user->tokens()->delete();
        
        // Create new token
        $token = $user->createToken('api-token')->plainTextToken;
        
        return response()->json(['token' => $token]);
    }
}
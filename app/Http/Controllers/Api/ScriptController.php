<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Script;
use Illuminate\Http\Request;

class ScriptController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->scripts()->latest()->get();
    }
    
    public function store(Request $request)
    {
        // n8n will send user_id to associate script with user
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'topic' => 'required|string',
            'script' => 'required|string',
            'status' => 'string'
        ]);
        
        $script = Script::create($validated);
        return response()->json($script, 201);
    }
}
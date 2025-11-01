<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Script;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ScriptController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->scripts()->latest()->get();
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'niche' => 'nullable|string',
            'metadata' => 'nullable|array'
        ]);

        $metadata = $validated['metadata'] ?? [];
        $metadata['generation_type'] = 'manual';
        $metadata['status'] = 'done';
        $metadata['word_count'] = str_word_count($validated['content']);
        $metadata['estimated_duration'] = ceil($metadata['word_count'] / 150) . ' minutes';
        
        $script = Script::create([
            'user_id' => $request->user()->id,
            'title' => $validated['title'],
            'content' => $validated['content'],
            'niche' => $validated['niche'],
            'metadata' => $metadata
        ]);

        return response()->json($script, 201);
    }

    /**
     * Save generated script from n8n
     * n8n calls this endpoint
     */
    public function saveScript(Request $request, string $user_uuid): JsonResponse
    {
        $user = User::find($user_uuid);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'niche' => 'nullable|string',
            'user_uuid' => 'nullable|string', // Allow but ignore
            'metadata' => 'nullable|array'
        ]);

        $metadata = $validated['metadata'] ?? [];
        $metadata['generation_type'] = $metadata['generation_type'] ?? 'auto_generated';
        $metadata['status'] = 'done';
        $metadata['word_count'] = str_word_count($validated['content']);
        $metadata['estimated_duration'] = ceil($metadata['word_count'] / 150) . ' minutes';
        
        $script = Script::create([
            'user_id' => $user->id,
            'title' => $validated['title'],
            'content' => $validated['content'],
            'niche' => $validated['niche'],
            'metadata' => $metadata
        ]);

        return response()->json([
            'success' => true,
            'script_id' => $script->id,
            'message' => 'Script saved successfully'
        ], 201);
    }

    /**
     * Save script from n8n (public endpoint)
     * n8n calls this with user_uuid in body
     */
    public function saveScriptFromN8n(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_uuid' => 'required|string',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'niche' => 'nullable|string',
            'metadata' => 'nullable|array'
        ]);

        $user = User::find($validated['user_uuid']);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $metadata = $validated['metadata'] ?? [];
        $metadata['generation_type'] = $metadata['generation_type'] ?? 'auto_generated';
        $metadata['status'] = 'done';
        $metadata['word_count'] = str_word_count($validated['content']);
        $metadata['estimated_duration'] = ceil($metadata['word_count'] / 150) . ' minutes';

        $script = Script::create([
            'user_id' => $user->id,
            'title' => $validated['title'],
            'content' => $validated['content'],
            'niche' => $validated['niche'],
            'metadata' => $metadata
        ]);

        return response()->json([
            'success' => true,
            'script_id' => $script->id,
            'message' => 'Script saved successfully'
        ], 201);
    }

    /**
     * Trigger script generation in n8n
     * Your web app calls this
     */
    public function triggerGeneration(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_uuid' => 'required|uuid|exists:users,id',
            'type' => 'required|string',
            'parameters' => 'nullable|array'
        ]);

        // Here you would trigger your n8n workflow
        // For now, return success response
        return response()->json([
            'success' => true,
            'message' => 'Generation triggered',
            'user_uuid' => $validated['user_uuid'],
            'type' => $validated['type']
        ]);
    }

    /**
     * Show a specific script
     */
    public function show(Script $script): JsonResponse
    {
        // Check if user owns this script
        if ($script->user_id !== request()->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($script);
    }

    /**
     * Delete a script
     */
    public function destroy(Script $script): JsonResponse
    {
        // Check if user owns this script
        if ($script->user_id !== request()->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $script->delete();

        return response()->json(['success' => true, 'message' => 'Script deleted successfully']);
    }
}
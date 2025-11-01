<?php

namespace App\Http\Controllers;

use App\Models\Script;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ScriptController extends Controller
{
    public function index()
    {
        return view('scripts');
    }

    public function show(Script $script): JsonResponse
    {
        // Check if user owns this script
        if ($script->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($script);
    }

    public function destroy(Script $script): JsonResponse
    {
        // Check if user owns this script
        if ($script->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $script->delete();

        return response()->json(['success' => true, 'message' => 'Script deleted successfully']);
    }
}
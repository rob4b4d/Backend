<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; // Ensure this is included
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the history records.
     */
public function index(Request $request)
{
    $user = $request->user();

    $histories = History::with(['fareCollection']) // Only include fareCollection
        ->where('user_id', $user->id)
        ->get();

    return $histories->map(function ($history) {
        return [
            'id' => $history->id,
            'fare_id' => $history->fareCollection->fare_id,
            'fare_location' => $history->fareCollection->fare_location, // Added fare_location
            'regular_total' => $history->fareCollection->regular_total,
            'discounted_total' => $history->fareCollection->discounted_total,
            'date' => $history->created_at->toDateString(),
        ];
    });
}   
    
    
    /**
     * Store a newly created history record in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fcollection_id' => 'required|exists:fare_collections,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $history = History::create($validated);
    
        // Reload relationships
        $history->load(['user', 'fareCollection']);

        return response()->json([
            'message' => 'History record created successfully.',
            'data' => $history,
        ], 201);
    }

    /**
     * Display the specified history record.
     */
    public function show($id)
    {
        $history = History::with(['user', 'fareCollection'])->findOrFail($id);
        return response()->json($history);
    }

    /**
     * Update the specified history record.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'fcollection_id' => 'sometimes|exists:fare_collections,id',
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $history = History::findOrFail($id);
        $history->update($validated);

        return response()->json([
            'message' => 'History record updated successfully.',
            'data' => $history,
        ]);
    }

    /**
     * Remove the specified history record from storage.
     */
    public function destroy($id)
    {
        $history = History::findOrFail($id);
        $history->delete();

        return response()->json([
            'message' => 'History record deleted successfully.',
        ]);
    }
}

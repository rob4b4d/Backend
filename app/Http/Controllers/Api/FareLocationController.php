<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FareLocation;
use Illuminate\Http\Request;

class FareLocationController extends Controller
{
    // Define default fare locations
    protected $defaultLocations = [
        'Asingan',
        'Sta. Maria',
        'Urdaneta',
        'Dagupan',
    ];

    // Display a listing of fare locations
    public function index()
    {
        $fareLocations = FareLocation::with('fare')->get();
        return response()->json($fareLocations);
    }

    // Store a new fare location
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'fare_location' => 'required|string|unique:fare_locations,fare_location', // Ensure fare_location is unique
            'regular_price' => 'required|numeric',
            'discounted_price' => 'required|numeric',
            'fare_id' => 'required|exists:fares,id',
        ]);

        // Check if the location already exists in the predefined locations
        if (in_array($validated['fare_location'], $this->defaultLocations)) {
            // If it exists, check if it's already in the database
            if (FareLocation::where('fare_location', $validated['fare_location'])->exists()) {
                return response()->json(['error' => 'This fare location already exists in the system.'], 400);
            }
        }

        // Create the new fare location if not duplicate
        $fareLocation = FareLocation::create($validated);
        return response()->json($fareLocation, 201);
    }

    // Display the specified fare location
    public function show($id)
    {
        $fareLocation = FareLocation::with('fare')->findOrFail($id);
        return response()->json($fareLocation);
    }

    // Update the specified fare location
    public function update(Request $request, $id)
    {
        $fareLocation = FareLocation::findOrFail($id);
        $validated = $request->validate([
            'fare_location' => 'string|unique:fare_locations,fare_location,' . $id, // Make the fare_location unique excluding the current one
            'regular_price' => 'numeric',
            'discounted_price' => 'numeric',
            'fare_id' => 'exists:fares,id',
        ]);

        $fareLocation->update($validated);
        return response()->json($fareLocation);
    }

    // Remove the specified fare location
    public function destroy($id)
    {
        $fareLocation = FareLocation::findOrFail($id);
        $fareLocation->delete();
        return response()->json(null, 204);
    }
}

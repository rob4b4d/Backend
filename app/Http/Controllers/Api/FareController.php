<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fare;
use Illuminate\Http\Request;

class FareController extends Controller
{
    // Define a constant array of valid locations
    protected $locations = [
        'Asingan',
        'Sta. Maria',
        'Urdaneta',
        'Dagupan',
    ];

    /**
     * Display a listing of fares.
     * If a location query parameter is provided, filter fares by that location.
     */
    public function index(Request $request)
    {
        // Get the location parameter from the query string
        $location = $request->query('location');

        if ($location) {
            // Validate if the location exists in the predefined list
            if (!in_array($location, $this->locations)) {
                return response()->json([
                    'error' => 'Invalid location provided. Valid locations are: ' . implode(', ', $this->locations),
                ], 400);
            }

            // Filter fares by the provided location
            $fares = Fare::where('fare_location', $location)->get();
        } else {
            // Fetch all fares if no location is provided
            $fares = Fare::all();
        }

        return response()->json($fares);
    }

    /**
     * Store a new fare.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'fare_location' => 'required|string|in:' . implode(',', $this->locations),
        ]);

        // Create the fare record
        $fare = Fare::create($validated);

        return response()->json($fare, 201);
    }

    /**
     * Display the specified fare.
     */
    public function show($id)
    {
        $fare = Fare::findOrFail($id); // Find the fare by ID or fail
        return response()->json($fare);
    }

    /**
     * Update the specified fare.
     */
    public function update(Request $request, $id)
    {
        $fare = Fare::findOrFail($id); // Find the fare by ID or fail

        // Validate the input data
        $validated = $request->validate([
            'fare_location' => 'string|in:' . implode(',', $this->locations),
        ]);

        $fare->update($validated); // Update the fare with validated data

        return response()->json($fare);
    }

    /**
     * Remove the specified fare.
     */
    public function destroy($id)
    {
        $fare = Fare::findOrFail($id); // Find the fare by ID or fail
        $fare->delete(); // Delete the fare

        return response()->json(null, 204);
    }
}

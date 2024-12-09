<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FareCollection;
use Illuminate\Http\Request;

class FareCollectionController extends Controller
{
    // Display a listing of fare collections
    public function index()
    {
        // Include the 'fare' and 'user' relationships in the query
        $fareCollections = FareCollection::with('fare', 'user')->get();
        return response()->json($fareCollections);
    }

    // Store a new fare collection
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'route' => 'required|integer',
            'regular_total' => 'required|string',
            'discounted_total' => 'required|string',
            'pick_up_total' => 'required|string',
            'user_id' => 'required|exists:users,id', // Ensure user_id exists in the users table
            'fare_id' => 'required|exists:fares,id',  // Ensure fare_id exists in the fares table
        ]);

        // Create a new fare collection based on validated data
        $fareCollection = FareCollection::create($validated);
        return response()->json($fareCollection, 201); // Return the created fare collection
    }

    // Display the specified fare collection
    public function show($id)
    {
        // Retrieve the fare collection with its related fare and user data
        $fareCollection = FareCollection::with('fare', 'user')->findOrFail($id);
        return response()->json($fareCollection);
    }

    // Update the specified fare collection
    public function update(Request $request, $id)
    {
        // Find the fare collection by ID
        $fareCollection = FareCollection::findOrFail($id);

        // Validate the incoming update request
        $validated = $request->validate([
            'route' => 'integer',
            'regular_total' => 'string',
            'discounted_total' => 'string',
            'pick_up_total' => 'string',
            'user_id' => 'exists:users,id',  // Ensure user_id exists in the users table
            'fare_id' => 'exists:fares,id',   // Ensure fare_id exists in the fares table
        ]);

        // Update the fare collection with the validated data
        $fareCollection->update($validated);
        return response()->json($fareCollection); // Return the updated fare collection
    }

    // Remove the specified fare collection
    public function destroy($id)
    {
        // Find and delete the fare collection by ID
        $fareCollection = FareCollection::findOrFail($id);
        $fareCollection->delete();
        return response()->json(null, 204); // Return a successful delete response
    }
}

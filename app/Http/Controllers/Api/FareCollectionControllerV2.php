<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FareCollection;
use Illuminate\Http\Request;

class FareCollectionControllerV2 extends Controller
{

  // Display a listing of fare collections
  public function index(Request $request)
  {
      // Get the user_id and date from the request query parameters
      $userId = $request->query('user_id');
      $date = $request->query('date');  // Default to today's date if no date is provided
  
      // Build the query to filter by user_id and date
      $query = FareCollection::with(['fare', 'user']);
  
      // Apply the user_id filter if it's provided
      if ($userId) {
          $query->where('user_id', $userId);
      }
  
      // Apply the date filter if provided
      if ($date) {
          $query->whereDate('created_at', $date);
      }
  
      // Execute the query and get the results
      $fareCollections = $query->get();
  
      return response()->json($fareCollections);
  }
  

    // Store a newly created fare collection
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'regular_total' => 'required|numeric|min:0',
                'discounted_total' => 'required|numeric|min:0',
                'fare_id' => 'required|exists:fares,id',
                'user_id' => 'required|exists:users,id',
                'bus_num' => 'required|integer',
                'route' => 'required|integer',
            ]);

            $fareCollection = FareCollection::create($validated);
            return response()->json($fareCollection, 201);
        } catch (\Exception $e) {
            \Log::error('Error saving fare collection: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to save fare collection'], 500);
        }
    }

    // Display the specified fare collection
    public function show($id)
    {
        $fareCollection = FareCollection::with(['fare', 'user'])->findOrFail($id);
        return response()->json($fareCollection);
    }

    // Update the specified fare collection
    public function update(Request $request, $id)
    {
        $fareCollection = FareCollection::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'regular_total' => 'required|numeric|min:0',
            'discounted_total' => 'required|numeric|min:0',
            'fare_id' => 'required|exists:fares,id',
            'user_id' => 'required|exists:users,id',
            'bus_num' => 'required|integer',
            'route' => 'required|integer',
        ]);

        $fareCollection->update($validated);
        return response()->json($fareCollection);
    }

    // Remove the specified fare collection
    public function destroy($id)
    {
        $fareCollection = FareCollection::findOrFail($id);
        $fareCollection->delete();
        return response()->json(null, 204);
    }
}

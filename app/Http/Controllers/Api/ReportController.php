<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Display a listing of reports
    public function index()
    {
        $reports = Report::with(['user', 'fare', 'fareCollection'])->get();
        return response()->json($reports);
    }

    // Store a new report
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'fare_id' => 'required|exists:fares,id',
            'fare_collection_id' => 'required|exists:fare_collections,id',
        ]);

        $report = Report::create($validated);
        return response()->json($report, 201);
    }

    // Display the specified report
    public function show($id)
    {
        $report = Report::with(['user', 'fare', 'fareCollection'])->findOrFail($id);
        return response()->json($report);
    }

    // Update the specified report
    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $validated = $request->validate([
            'user_id' => 'exists:users,id',
            'fare_id' => 'exists:fares,id',
            'fare_collection_id' => 'exists:fare_collections,id',
        ]);

        $report->update($validated);
        return response()->json($report);
    }

    // Remove the specified report
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return response()->json(null, 204);
    }
}

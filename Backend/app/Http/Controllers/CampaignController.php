<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Campaign::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Create campaign form'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'body' => 'required|string',
        ]);

        $campaign = Campaign::create([
            'subject' => $request->subject,
            'body' => $request->body,
        ]);

        return response()->json(['message' => 'Campaign created successfully', 'data' => $campaign], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        return response()->json($campaign, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'subject' => 'required|string',
            'body' => 'required|string',
        ]);

        $campaign->update([
            'subject' => $request->subject,
            'body' => $request->body,
        ]);

        return response()->json(['message' => 'Campaign updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return response()->json(['message' => 'Campaign deleted successfully'], 200);
    }
}


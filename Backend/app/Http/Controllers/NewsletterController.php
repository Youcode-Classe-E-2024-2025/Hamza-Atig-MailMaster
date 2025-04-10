<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Newsletter::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $newsletter = Newsletter::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Newsletter created successfully', 'data' => $newsletter], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Newsletter $newsletter)
    {
        return response()->json($newsletter, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $newsletter->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Newsletter updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();

        return response()->json(['message' => 'Newsletter deleted successfully'], 200);
    }
}


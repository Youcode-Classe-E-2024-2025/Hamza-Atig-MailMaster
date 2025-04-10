<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribers = Subscriber::all();
        return response()->json(['data' => $subscribers], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Create subscriber form'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|unique:subscribers',
        ]);

        $subscriber = Subscriber::create([
            'email' => $request->email,
        ]);

        return response()->json(['message' => 'Subscriber created successfully', 'data' => $subscriber], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscriber $subscriber)
    {
        return response()->json(['data' => $subscriber], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscriber $subscriber)
    {
        return response()->json(['message' => 'Edit subscriber form', 'data' => $subscriber], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        $request->validate([
            'email' => 'required|string|email|unique:subscribers,email,' . $subscriber->id,
        ]);

        $subscriber->update([
            'email' => $request->email,
        ]);

        return response()->json(['message' => 'Subscriber updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        return response()->json(['message' => 'Subscriber deleted successfully'], 200);
    }
}


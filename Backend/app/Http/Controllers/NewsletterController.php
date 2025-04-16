<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Newsletter;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;

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

        $campaign = Campaign::latest()->first();

        if (!$campaign) {
            return response()->json([
                'message' => 'No campaign available to use for sending the newsletter.'
            ], 400);
        }

        $newsletter = Newsletter::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        $subscribers = Subscriber::all();

        foreach ($subscribers as $subscriber) {
            Mail::send('newsletter', [
                'subject' => $campaign->subject,
                'body' => $campaign->body,
            ], function ($message) use ($subscriber, $campaign) {
                $message->to($subscriber->email);
                $message->subject($campaign->subject);
                $message->from('hamzaatig58@gmail.com', 'MailMaster');
            });
        }

        return response()->json([
            'message' => 'Newsletter created and campaign sent to all subscribers.',
            'data' => $newsletter
        ], 201);
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


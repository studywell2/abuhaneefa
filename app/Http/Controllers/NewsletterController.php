<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        Newsletter::firstOrCreate(
            ['email' => $validated['email']],
        );

        return redirect()
            ->route('home')
            ->with('newsletter_success', 'Thank you for subscribing! You will receive updates from Abu Haneefah Islamic Academy, Insha\'Allah.');
    }
}

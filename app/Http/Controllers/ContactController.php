<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display contact page.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Store contact form submission.
     */
    public function store(Request $request)
    {
        // Honeypot check - if filled, it's a bot
        if ($request->filled('website')) {
            return back()->with('error', 'Invalid submission detected.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Here you can save to database or send email
        // For now, just redirect back with success message
        return redirect()->route('home')->with('success', 'Thank you! We will contact you soon.');
    }
}
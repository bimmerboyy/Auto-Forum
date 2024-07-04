<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('auto_forum_info');
    }
    public function submit(Request $request)
    {
        // Handle the form submission
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // You can process the data here, e.g., send an email or save to the database

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}

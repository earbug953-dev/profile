<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Project;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /** Show the main portfolio page */
    public function index()
    {
        $featuredProject = Project::visible()->featured()->ordered()->first();
        $projects        = Project::visible()->ordered()->get();

        return view('portfolio', compact('projects', 'featuredProject'));
    }

    /** Handle contact form submission */
    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:150',
            'email'        => 'required|email|max:255',
            'project_type' => 'nullable|string|max:100',
            'budget'       => 'nullable|string|max:100',
            'message'      => 'required|string|min:10|max:3000',
        ]);

        Message::create($validated);

        return back()->with('success', 'Thanks! I\'ll get back to you within 24 hours.');
    }
}

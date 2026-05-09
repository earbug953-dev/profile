<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /* ──────────────────────────────────────────────
     | Projects CRUD
     ──────────────────────────────────────────────*/

    public function index()
    {
        $projects = Project::ordered()->get();
        $messages = Message::latest()->take(5)->get();
        $unread   = Message::where('is_read', false)->count();

        return view('admin.projects.index', compact('projects', 'messages', 'unread'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateProject($request);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        // Convert tech_stack string to array
        $validated['tech_stack'] = $this->parseTechStack($request->tech_stack_raw);

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project added successfully!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $this->validateProject($request, $project->id);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['tech_stack'] = $this->parseTechStack($request->tech_stack_raw);

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted.');
    }

    /** Toggle visibility */
    public function toggleVisibility(Project $project)
    {
        $project->update(['is_visible' => ! $project->is_visible]);
        return back()->with('success', 'Visibility updated.');
    }

    /** Toggle featured */
    public function toggleFeatured(Project $project)
    {
        $project->update(['featured' => ! $project->featured]);
        return back()->with('success', 'Featured status updated.');
    }

    /* ──────────────────────────────────────────────
     | Messages
     ──────────────────────────────────────────────*/

    public function messages()
    {
        $messages = Message::latest()->paginate(15);
        $unread   = Message::where('is_read', false)->count();

        Message::where('is_read', false)->update(['is_read' => true]);

        return view('admin.messages', compact('messages', 'unread'));
    }

    public function destroyMessage(Message $message)
    {
        $message->delete();
        return back()->with('success', 'Message deleted.');
    }

    /* ──────────────────────────────────────────────
     | Helpers
     ──────────────────────────────────────────────*/

    private function validateProject(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title'       => 'required|string|max:200',
            'type'        => 'required|string|max:80',
            'description' => 'required|string',
            'project_url' => 'nullable|url|max:255',
            'github_url'  => 'nullable|url|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'featured'    => 'boolean',
            'is_visible'  => 'boolean',
            'sort_order'  => 'integer|min:0',
        ]);
    }

    private function parseTechStack(string $raw): array
    {
        return array_filter(
            array_map('trim', explode(',', $raw))
        );
    }
}

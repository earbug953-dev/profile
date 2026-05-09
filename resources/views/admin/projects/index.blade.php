@extends('layouts.admin')

@section('title', 'Projects')
@section('breadcrumb', 'Projects')

@section('topbar-action')
  <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">+ Add Project</a>
@endsection

@section('content')

{{-- STATS --}}
<div class="stat-cards">
  <div class="stat-card">
    <div class="stat-card-num">{{ $projects->count() }}</div>
    <div class="stat-card-label">Total Projects</div>
  </div>
  <div class="stat-card">
    <div class="stat-card-num">{{ $projects->where('is_visible', true)->count() }}</div>
    <div class="stat-card-label">Visible</div>
  </div>
  <div class="stat-card">
    <div class="stat-card-num">{{ $projects->where('featured', true)->count() }}</div>
    <div class="stat-card-label">Featured</div>
  </div>
  <div class="stat-card">
    <div class="stat-card-num">{{ $unread }}</div>
    <div class="stat-card-label">Unread Messages</div>
  </div>
</div>

{{-- PROJECTS TABLE --}}
<div class="table-wrap">
  <div class="table-header">
    <span class="table-header-title">// All Projects</span>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">+ Add New</a>
  </div>

  @if($projects->isEmpty())
    <div class="empty-state">
      <p>No projects yet. <a href="{{ route('admin.projects.create') }}" style="color:var(--accent)">Add your first project →</a></p>
    </div>
  @else
    <table>
      <thead>
        <tr>
          <th>Project</th>
          <th>Type</th>
          <th>Stack</th>
          <th>Status</th>
          <th>Featured</th>
          <th>Order</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($projects as $project)
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:1rem;">
              @if($project->image)
                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="project-thumb">
              @else
                <div class="project-thumb-placeholder">💻</div>
              @endif
              <div>
                <div style="font-weight:500;font-size:0.92rem;">{{ $project->title }}</div>
                <div style="font-family:var(--mono);font-size:0.62rem;color:var(--muted);margin-top:0.2rem;">
                  {{ Str::limit($project->description, 60) }}
                </div>
              </div>
            </div>
          </td>
          <td>
            <span class="badge-pill badge-yellow">{{ $project->type }}</span>
          </td>
          <td>
            <div style="display:flex;flex-wrap:wrap;gap:0.3rem;max-width:200px;">
              @foreach(array_slice($project->tech_stack, 0, 3) as $tech)
                <span style="font-family:var(--mono);font-size:0.6rem;color:var(--accent);background:rgba(57,255,133,0.07);border:1px solid rgba(57,255,133,0.15);padding:0.15rem 0.4rem;">{{ $tech }}</span>
              @endforeach
              @if(count($project->tech_stack) > 3)
                <span style="font-family:var(--mono);font-size:0.6rem;color:var(--muted);">+{{ count($project->tech_stack) - 3 }}</span>
              @endif
            </div>
          </td>
          <td>
            <form action="{{ route('admin.projects.toggle-visibility', $project) }}" method="POST">
              @csrf @method('PATCH')
              <button type="submit" class="badge-pill {{ $project->is_visible ? 'badge-green' : 'badge-red' }}" style="border:none;cursor:pointer;background:inherit;">
                {{ $project->is_visible ? 'Visible' : 'Hidden' }}
              </button>
            </form>
          </td>
          <td>
            <form action="{{ route('admin.projects.toggle-featured', $project) }}" method="POST">
              @csrf @method('PATCH')
              <button type="submit" style="background:none;border:none;cursor:pointer;font-size:1.2rem;" title="{{ $project->featured ? 'Remove featured' : 'Set as featured' }}">
                {{ $project->featured ? '⭐' : '☆' }}
              </button>
            </form>
          </td>
          <td style="font-family:var(--mono);font-size:0.78rem;color:var(--muted);">
            {{ $project->sort_order }}
          </td>
          <td>
            <div class="actions">
              @if($project->project_url)
                <a href="{{ $project->project_url }}" target="_blank" class="btn btn-ghost btn-sm" title="View live">🔗</a>
              @endif
              <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-ghost btn-sm">Edit</a>
              <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete \'{{ addslashes($project->title) }}\'?');">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Del</button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</div>

{{-- RECENT MESSAGES --}}
@if($messages->count())
<div class="table-wrap" style="margin-top:2rem;">
  <div class="table-header">
    <span class="table-header-title">// Recent Messages</span>
    <a href="{{ route('admin.messages') }}" class="btn btn-ghost btn-sm">View All →</a>
  </div>
  <table>
    <thead>
      <tr>
        <th>From</th>
        <th>Project Type</th>
        <th>Budget</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($messages as $msg)
      <tr>
        <td>
          <div style="font-weight:500;">{{ $msg->name }}</div>
          <div style="font-family:var(--mono);font-size:0.65rem;color:var(--muted);">{{ $msg->email }}</div>
        </td>
        <td style="font-size:0.85rem;color:var(--muted);">{{ $msg->project_type ?: '—' }}</td>
        <td style="font-family:var(--mono);font-size:0.78rem;">{{ $msg->budget ?: '—' }}</td>
        <td style="font-family:var(--mono);font-size:0.72rem;color:var(--muted);">{{ $msg->created_at->diffForHumans() }}</td>
        <td><span class="badge-pill {{ $msg->is_read ? 'badge-green' : 'badge-yellow' }}">{{ $msg->is_read ? 'Read' : 'New' }}</span></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endif

@endsection

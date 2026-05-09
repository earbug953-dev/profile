@extends('layouts.admin')

@section('title', 'Edit Project')
@section('breadcrumb', 'Projects / Edit')

@section('topbar-action')
  <a href="{{ route('admin.projects.index') }}" class="btn btn-ghost">← Back</a>
@endsection

@section('content')

<div class="form-card">
  <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Project Title *</label>
        <input class="form-input @error('title') error @enderror"
               name="title" type="text" value="{{ old('title', $project->title) }}" required>
        @error('title')<span class="form-error">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Project Type *</label>
        <select class="form-select @error('type') error @enderror" name="type" required>
          @foreach(['E-Commerce','SaaS','API / Backend','Full Stack','Mobile App','Landing Page','Dashboard','Other'] as $t)
            <option value="{{ $t }}" {{ old('type', $project->type) === $t ? 'selected' : '' }}>{{ $t }}</option>
          @endforeach
        </select>
        @error('type')<span class="form-error">{{ $message }}</span>@enderror
      </div>
    </div>

    <div class="form-group">
      <label class="form-label">Description *</label>
      <textarea class="form-textarea @error('description') error @enderror" name="description" required>{{ old('description', $project->description) }}</textarea>
      @error('description')<span class="form-error">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label class="form-label">Tech Stack (comma-separated)</label>
      <input class="form-input" name="tech_stack_raw" type="text"
             value="{{ old('tech_stack_raw', implode(', ', $project->tech_stack)) }}">
      <div class="form-hint">Separate with commas</div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Live URL</label>
        <input class="form-input" name="project_url" type="url" value="{{ old('project_url', $project->project_url) }}">
      </div>
      <div class="form-group">
        <label class="form-label">GitHub URL</label>
        <input class="form-input" name="github_url" type="url" value="{{ old('github_url', $project->github_url) }}">
      </div>
    </div>

    <div class="form-group">
      <label class="form-label">Project Image</label>
      @if($project->image)
        <div style="margin-bottom:0.8rem;display:flex;align-items:center;gap:1rem;">
          <img src="{{ $project->image_url }}" alt="Current" style="height:60px;width:auto;border:1px solid var(--border);">
          <span style="font-family:var(--mono);font-size:0.65rem;color:var(--muted);">Current image</span>
        </div>
      @endif
      <input class="form-input" name="image" type="file" accept="image/jpg,image/jpeg,image/png,image/webp">
      <div class="form-hint">Leave blank to keep the current image</div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Sort Order</label>
        <input class="form-input" name="sort_order" type="number" value="{{ old('sort_order', $project->sort_order) }}" min="0">
      </div>
      <div class="form-group" style="padding-top:1.8rem;">
        <div class="checkbox-row" style="margin-bottom:0.8rem;">
          <input type="hidden" name="featured" value="0">
          <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }}>
          <label for="featured">Featured Project</label>
        </div>
        <div class="checkbox-row">
          <input type="hidden" name="is_visible" value="0">
          <input type="checkbox" name="is_visible" id="is_visible" value="1" {{ old('is_visible', $project->is_visible) ? 'checked' : '' }}>
          <label for="is_visible">Visible on Portfolio</label>
        </div>
      </div>
    </div>

    <div style="display:flex;gap:1rem;margin-top:0.5rem;">
      <button type="submit" class="btn btn-primary">Update Project</button>
      <a href="{{ route('admin.projects.index') }}" class="btn btn-ghost">Cancel</a>
      <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
            onsubmit="return confirm('Delete this project?');" style="margin-left:auto;">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Project</button>
      </form>
    </div>
  </form>
</div>

@endsection

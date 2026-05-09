@extends('layouts.admin')

@section('title', 'Add Project')
@section('breadcrumb', 'Projects / Add New')

@section('topbar-action')
  <a href="{{ route('admin.projects.index') }}" class="btn btn-ghost">← Back</a>
@endsection

@section('content')

<div class="form-card">
  <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Project Title *</label>
        <input class="form-input @error('title') error @enderror"
               name="title" type="text" value="{{ old('title') }}"
               placeholder="e.g. Multi-Vendor Marketplace" required>
        @error('title')<span class="form-error">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Project Type *</label>
        <select class="form-select @error('type') error @enderror" name="type" required>
          <option value="">Select type...</option>
          @foreach(['E-Commerce','SaaS','API / Backend','Full Stack','Mobile App','Landing Page','Dashboard','Other'] as $t)
            <option value="{{ $t }}" {{ old('type') === $t ? 'selected' : '' }}>{{ $t }}</option>
          @endforeach
        </select>
        @error('type')<span class="form-error">{{ $message }}</span>@enderror
      </div>
    </div>

    <div class="form-group">
      <label class="form-label">Description *</label>
      <textarea class="form-textarea @error('description') error @enderror"
                name="description" placeholder="Describe what you built, the challenge, and the outcome..." required>{{ old('description') }}</textarea>
      @error('description')<span class="form-error">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label class="form-label">Tech Stack (comma-separated) *</label>
      <input class="form-input @error('tech_stack_raw') error @enderror"
             name="tech_stack_raw" type="text" value="{{ old('tech_stack_raw') }}"
             placeholder="Laravel 10, MySQL, Vue.js, Redis, Docker">
      <div class="form-hint">Separate technologies with commas. e.g. Laravel, MySQL, Vue.js</div>
      @error('tech_stack_raw')<span class="form-error">{{ $message }}</span>@enderror
    </div>

    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Live URL</label>
        <input class="form-input @error('project_url') error @enderror"
               name="project_url" type="url" value="{{ old('project_url') }}"
               placeholder="https://yourproject.com">
        @error('project_url')<span class="form-error">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">GitHub URL</label>
        <input class="form-input @error('github_url') error @enderror"
               name="github_url" type="url" value="{{ old('github_url') }}"
               placeholder="https://github.com/omurukamichael/project">
        @error('github_url')<span class="form-error">{{ $message }}</span>@enderror
      </div>
    </div>

    <div class="form-group">
      <label class="form-label">Project Screenshot / Image</label>
      <input class="form-input" name="image" type="file" accept="image/jpg,image/jpeg,image/png,image/webp">
      <div class="form-hint">JPG, PNG or WebP · Max 2MB · Recommended 1200×800px</div>
      @error('image')<span class="form-error">{{ $message }}</span>@enderror
    </div>

    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Sort Order</label>
        <input class="form-input" name="sort_order" type="number" value="{{ old('sort_order', 0) }}" min="0" placeholder="0">
        <div class="form-hint">Lower numbers appear first</div>
      </div>
      <div class="form-group" style="padding-top:1.8rem;">
        <div class="checkbox-row" style="margin-bottom:0.8rem;">
          <input type="hidden" name="featured" value="0">
          <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
          <label for="featured">Mark as Featured (shows large on portfolio)</label>
        </div>
        <div class="checkbox-row">
          <input type="hidden" name="is_visible" value="0">
          <input type="checkbox" name="is_visible" id="is_visible" value="1" checked {{ old('is_visible', true) ? 'checked' : '' }}>
          <label for="is_visible">Visible on Portfolio</label>
        </div>
      </div>
    </div>

    <div style="display:flex;gap:1rem;margin-top:0.5rem;">
      <button type="submit" class="btn btn-primary">Save Project</button>
      <a href="{{ route('admin.projects.index') }}" class="btn btn-ghost">Cancel</a>
    </div>
  </form>
</div>

@endsection

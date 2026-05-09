<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Project extends Model
{
    protected $fillable = [
        'title',
        'type',
        'description',
        'tech_stack',
        'project_url',
        'github_url',
        'image',
        'featured',
        'sort_order',
        'is_visible',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'featured'   => 'boolean',
        'is_visible' => 'boolean',
    ];

    /* Scopes */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('created_at');
    }

    /* Helpers */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/project-placeholder.png');
    }
}

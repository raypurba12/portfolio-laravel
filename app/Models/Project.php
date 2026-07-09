<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('frontend.home'));
        static::deleted(fn () => Cache::forget('frontend.home'));
    }

    protected $fillable = [
        'title',
        'slug',
        'project_category_id',
        'thumbnail_path',
        'video_url',
        'description',
        'technology_stack',
        'github_url',
        'live_demo_url',
        'status',
        'featured',
        'client',
        'date',
    ];

    protected $casts = [
        'date'     => 'date',
        'featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }

    /**
     * Kembalikan URL thumbnail — support URL eksternal maupun storage path.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if (!$this->thumbnail_path) return null;
        return Str::startsWith($this->thumbnail_path, ['http', 'https'])
            ? $this->thumbnail_path
            : Storage::url($this->thumbnail_path);
    }
}

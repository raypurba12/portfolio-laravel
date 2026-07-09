<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Hero extends Model
{
    use HasFactory, SoftDeletes;

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('frontend.home'));
        static::deleted(fn () => Cache::forget('frontend.home'));
    }

    protected $fillable = [
        'name',
        'title',
        'typing_text',
        'photo_path',
        'background_path',
        'cv_path',
        'github_url',
        'linkedin_url',
        'instagram_url',
        'whatsapp_url',
        'status',
    ];

    /**
     * Kembalikan URL foto — support URL eksternal maupun storage path.
     */
    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo_path) return null;
        if (Str::startsWith($this->photo_path, ['http', 'https'])) return $this->photo_path;
        $path = Str::after($this->photo_path, 'public/');
        return asset('storage/' . ltrim($path, '/'));
    }

    /**
     * Kembalikan URL background.
     */
    public function getBackgroundUrlAttribute(): ?string
    {
        if (!$this->background_path) return null;
        if (Str::startsWith($this->background_path, ['http', 'https'])) return $this->background_path;
        $path = Str::after($this->background_path, 'public/');
        return asset('storage/' . ltrim($path, '/'));
    }

    /**
     * Kembalikan URL CV.
     */
    public function getCvUrlAttribute(): ?string
    {
        if (!$this->cv_path) return null;
        if ($this->cv_path === '#') return '#';
        if (Str::startsWith($this->cv_path, ['http', 'https'])) return $this->cv_path;
        $path = Str::after($this->cv_path, 'public/');
        return asset('storage/' . ltrim($path, '/'));
    }
}

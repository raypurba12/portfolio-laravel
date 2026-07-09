<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class About extends Model
{
    use HasFactory, SoftDeletes;

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('frontend.home'));
        static::deleted(fn () => Cache::forget('frontend.home'));
    }

    protected $fillable = [
        'description',
        'birth_date',
        'location',
        'email',
        'phone',
        'language',
        'hobbies',
        'photo_path',
        'cv_path',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo_path) return null;
        if (Str::startsWith($this->photo_path, ['http', 'https'])) return $this->photo_path;
        $path = Str::after($this->photo_path, 'public/');
        return asset('storage/' . ltrim($path, '/'));
    }

    public function getCvUrlAttribute(): ?string
    {
        if (!$this->cv_path) return null;
        if ($this->cv_path === '#') return '#';
        if (Str::startsWith($this->cv_path, ['http', 'https'])) return $this->cv_path;
        $path = Str::after($this->cv_path, 'public/');
        return asset('storage/' . ltrim($path, '/'));
    }
}

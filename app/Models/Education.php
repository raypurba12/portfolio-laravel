<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Education extends Model
{
    use HasFactory, SoftDeletes;

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('frontend.home'));
        static::deleted(fn () => Cache::forget('frontend.home'));
    }

    protected $table = 'educations';

    protected $fillable = [
        'institution', 'degree', 'field_of_study', 'description',
        'logo_path', 'start_year', 'end_year', 'is_current', 'order',
    ];

    protected $casts = [
        'is_current' => 'boolean',
    ];

    public function getLogoUrlAttribute(): ?string
    {
        if (!$this->logo_path) return null;
        return Str::startsWith($this->logo_path, ['http', 'https'])
            ? $this->logo_path
            : Storage::url($this->logo_path);
    }
}

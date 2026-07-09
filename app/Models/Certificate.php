<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Certificate extends Model
{
    use HasFactory, SoftDeletes;

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('frontend.home'));
        static::deleted(fn () => Cache::forget('frontend.home'));
    }

    protected $fillable = [
        'name', 'number', 'issuer', 'issued_at', 'expiration_date', 'image_path', 'pdf_path', 'credential_url',
    ];

    protected $casts = [
        'issued_at'       => 'date',
        'expiration_date' => 'date',
    ];

    public function getIssueDateAttribute(): mixed
    {
        return $this->issued_at;
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? Storage::url($this->image_path) : null;
    }

    public function getPdfUrlAttribute(): ?string
    {
        return $this->pdf_path ? Storage::url($this->pdf_path) : null;
    }
}

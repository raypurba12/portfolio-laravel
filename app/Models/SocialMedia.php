<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SocialMedia extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('frontend.home'));
        static::deleted(fn () => Cache::forget('frontend.home'));
    }

    protected $table = 'social_media';

    protected $fillable = [
        'platform', 'label', 'url', 'icon', 'is_active', 'order',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function getIconClassAttribute(): string
    {
        return match ($this->platform) {
            'github'    => 'fab fa-github',
            'linkedin'  => 'fab fa-linkedin-in',
            'instagram' => 'fab fa-instagram',
            'facebook'  => 'fab fa-facebook-f',
            'tiktok'    => 'fab fa-tiktok',
            'youtube'   => 'fab fa-youtube',
            'whatsapp'  => 'fab fa-whatsapp',
            'twitter'   => 'fab fa-x-twitter',
            'website'   => 'fas fa-globe',
            default     => 'fas fa-link',
        };
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key with optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Get multiple settings at once — single query.
     */
    public static function batchGet(array $keys): array
    {
        $settings = [];
        $uncached = [];
        $now = now()->timestamp;

        foreach ($keys as $key) {
            $cacheKey = "setting_{$key}";
            $cached = Cache::get($cacheKey);
            if ($cached !== null) {
                $settings[$key] = $cached;
            } else {
                $uncached[] = $key;
            }
        }

        if (!empty($uncached)) {
            $rows = static::whereIn('key', $uncached)->pluck('value', 'key');
            foreach ($uncached as $key) {
                $value = $rows[$key] ?? null;
                $settings[$key] = $value;
                Cache::put("setting_{$key}", $value, 3600);
            }
        }

        return $settings;
    }

    /**
     * Set a setting value (create or update).
     */
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("setting_{$key}");
        Cache::forget('frontend.home');
    }
}

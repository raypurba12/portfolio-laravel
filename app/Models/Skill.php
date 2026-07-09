<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Skill extends Model
{
    use HasFactory, SoftDeletes;

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('frontend.home'));
        static::deleted(fn () => Cache::forget('frontend.home'));
    }

    protected $fillable = [
        'name',
        'skill_category_id',
        'logo_path',
        'percentage',
        'color',
        'featured',
        'order',
    ];

    public function category()
    {
        return $this->belongsTo(SkillCategory::class, 'skill_category_id');
    }
}

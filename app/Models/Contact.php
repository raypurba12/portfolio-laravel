<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'subject', 'message',
        'status', 'reply', 'replied_at', 'ip_address',
    ];

    protected $casts = ['replied_at' => 'datetime'];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('admin.unread_contact_count'));
        static::deleted(fn () => Cache::forget('admin.unread_contact_count'));
    }

    public function isUnread(): bool { return $this->status === 'unread'; }
    public function isRead(): bool   { return $this->status === 'read'; }
    public function isReplied(): bool{ return $this->status === 'replied'; }
}

<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['platform' => 'github',     'label' => 'GitHub',     'url' => 'https://github.com',       'order' => 1],
            ['platform' => 'linkedin',   'label' => 'LinkedIn',   'url' => 'https://linkedin.com',     'order' => 2],
            ['platform' => 'instagram',  'label' => 'Instagram',  'url' => 'https://instagram.com',    'order' => 3],
            ['platform' => 'youtube',    'label' => 'YouTube',    'url' => 'https://youtube.com',      'order' => 4],
            ['platform' => 'twitter',    'label' => 'Twitter',    'url' => 'https://x.com',            'order' => 5],
            ['platform' => 'tiktok',     'label' => 'TikTok',     'url' => 'https://tiktok.com',       'order' => 6],
            ['platform' => 'whatsapp',   'label' => 'WhatsApp',   'url' => 'https://wa.me/6281234567890', 'order' => 7],
            ['platform' => 'website',    'label' => 'Website',    'url' => 'https://example.com',      'order' => 8],
        ];

        foreach ($items as $item) {
            SocialMedia::create($item);
        }
    }
}

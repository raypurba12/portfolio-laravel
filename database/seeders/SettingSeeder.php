<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['key' => 'site_title',       'value' => 'Portfolio Laravel'],
            ['key' => 'site_description', 'value' => 'Full Stack Web Developer portfolio built with Laravel and Tailwind CSS.'],
            ['key' => 'site_email',       'value' => 'hello@example.com'],
            ['key' => 'site_address',     'value' => 'Jakarta, Indonesia'],
            ['key' => 'site_phone',       'value' => '+62 812-3456-7890'],
            ['key' => 'site_footer',      'value' => 'Built with ♥ Laravel'],
            ['key' => 'google_analytics', 'value' => null],
            ['key' => 'google_maps_embed','value' => null],
            ['key' => 'logo_path',        'value' => null],
            ['key' => 'favicon_path',     'value' => null],
        ];

        foreach ($items as $item) {
            Setting::set($item['key'], $item['value']);
        }
    }
}

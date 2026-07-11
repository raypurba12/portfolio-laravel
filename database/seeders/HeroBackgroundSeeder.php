<?php

namespace Database\Seeders;

use App\Models\HeroBackground;
use Illuminate\Database\Seeder;

class HeroBackgroundSeeder extends Seeder
{
    public function run(): void
    {
        HeroBackground::truncate();

        $backgrounds = [
            [
                'type' => 'image',
                'url' => 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?w=1920&q=80',
                'poster' => null,
                'duration' => 7000,
                'order' => 0,
                'is_active' => true,
            ],
            [
                'type' => 'video',
                'url' => 'https://assets.mixkit.co/videos/preview/mixkit-cyberpunk-neon-city-street-at-night-42283-large.mp4',
                'poster' => 'https://images.unsplash.com/photo-1503899036084-c55cdd92da26?w=1920&q=80',
                'duration' => 8000,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'type' => 'image',
                'url' => 'https://images.unsplash.com/photo-1578632767115-351597cf2477?w=1920&q=80',
                'poster' => null,
                'duration' => 7000,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'type' => 'video',
                'url' => 'https://assets.mixkit.co/videos/preview/mixkit-rain-falling-on-a-neon-sign-at-night-42284-large.mp4',
                'poster' => 'https://images.unsplash.com/photo-1540959733332-eab4deceeaf7?w=1920&q=80',
                'duration' => 8000,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'type' => 'image',
                'url' => 'https://images.unsplash.com/photo-1503899036084-c55cdd92da26?w=1920&q=80',
                'poster' => null,
                'duration' => 7000,
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($backgrounds as $bg) {
            HeroBackground::create($bg);
        }
    }
}

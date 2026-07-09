<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hero::create([
            'name' => 'John Doe',
            'title' => 'Full Stack Web Developer',
            'typing_text' => 'Laravel Enthusiast,Vue.js Follower,Code Artisan',
            'photo_path' => 'https://i.pravatar.cc/300',
            'background_path' => 'https://picsum.photos/seed/picsum/1920/1080',
            'cv_path' => '#',
            'github_url' => 'https://github.com',
            'linkedin_url' => 'https://linkedin.com',
            'instagram_url' => 'https://instagram.com',
            'whatsapp_url' => 'https://whatsapp.com',
            'status' => true,
        ]);
    }
}

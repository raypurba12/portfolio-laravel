<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::firstOrCreate(
            ['email' => 'john.doe@example.com'],
            [
                'description' => 'A passionate Full Stack Developer with 5+ years of experience in creating dynamic and responsive web applications. I specialize in the Laravel framework for the backend and Vue.js for the frontend. I love turning complex problems into simple, beautiful, and intuitive designs.',
                'birth_date' => '1995-05-15',
                'location' => 'Jakarta, Indonesia',
                'phone' => '+62 812 3456 7890',
                'language' => 'Indonesian, English',
                'hobbies' => 'Coding, Hiking, Photography, Reading',
                'photo_path' => null,
                'cv_path' => null,
            ],
        );
    }
}

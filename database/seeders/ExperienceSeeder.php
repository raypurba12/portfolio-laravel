<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'company'    => 'TechCorp Indonesia',
                'position'   => 'Senior Full Stack Developer',
                'description' => 'Leading the development of enterprise-scale web applications. Architected microservices backend using Laravel and built responsive frontends with Vue.js.',
                'location'   => 'Jakarta, Indonesia',
                'start_date' => '2023-01-01',
                'end_date'   => null,
                'is_current' => true,
                'order'      => 1,
            ],
            [
                'company'    => 'Startup Digital',
                'position'   => 'Full Stack Developer',
                'description' => 'Developed and maintained multiple client projects from concept to deployment. Worked closely with design team to create pixel-perfect interfaces.',
                'location'   => 'Bandung, Indonesia',
                'start_date' => '2021-06-01',
                'end_date'   => '2022-12-31',
                'is_current' => false,
                'order'      => 2,
            ],
            [
                'company'    => 'Freelance',
                'position'   => 'Web Developer',
                'description' => 'Built custom websites and web applications for various clients. Specialized in Laravel, WordPress, and e-commerce solutions.',
                'location'   => 'Remote',
                'start_date' => '2019-01-01',
                'end_date'   => '2021-05-31',
                'is_current' => false,
                'order'      => 3,
            ],
        ];

        foreach ($items as $item) {
            Experience::firstOrCreate(
                ['company' => $item['company'], 'position' => $item['position'], 'start_date' => $item['start_date']],
                $item,
            );
        }
    }
}

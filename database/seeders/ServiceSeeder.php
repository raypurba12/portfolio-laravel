<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name'             => 'Web Development',
                'icon'             => 'fas fa-code',
                'short_description' => 'Modern, responsive web applications built with Laravel, Vue.js, and Tailwind CSS.',
                'order'            => 1,
            ],
            [
                'name'             => 'Mobile Development',
                'icon'             => 'fas fa-mobile-alt',
                'short_description' => 'Cross-platform mobile apps using React Native and Flutter for iOS & Android.',
                'order'            => 2,
            ],
            [
                'name'             => 'UI/UX Design',
                'icon'             => 'fas fa-paint-brush',
                'short_description' => 'Clean, user-friendly interfaces designed with Figma focused on great user experience.',
                'order'            => 3,
            ],
            [
                'name'             => 'API Development',
                'icon'             => 'fas fa-plug',
                'short_description' => 'RESTful and GraphQL APIs built with Laravel, Node.js, and best practices.',
                'order'            => 4,
            ],
            [
                'name'             => 'DevOps & Deployment',
                'icon'             => 'fas fa-server',
                'short_description' => 'CI/CD pipelines, Docker containerization, and cloud deployment on AWS/GCP.',
                'order'            => 5,
            ],
            [
                'name'             => 'Consulting',
                'icon'             => 'fas fa-chart-line',
                'short_description' => 'Technical consulting for architecture decisions, code review, and performance optimization.',
                'order'            => 6,
            ],
        ];

        foreach ($items as $item) {
            $item['is_active'] = true;
            Service::firstOrCreate(
                ['name' => $item['name']],
                $item,
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ProjectCategory::all()->keyBy('name');

        $projects = [
            [
                'title' => 'E-Commerce Platform',
                'project_category_id' => $categories['Web Application']->id,
                'description' => 'A full-featured e-commerce platform built with Laravel and Vue.js, including payment gateway integration and a complete admin panel for managing products, orders, and customers.',
                'technology_stack' => 'Laravel, Vue.js, MySQL, Redis, Stripe',
                'github_url' => 'https://github.com',
                'live_demo_url' => 'https://example.com',
                'status' => 'published',
                'featured' => true,
                'client' => 'TechCorp',
                'date' => '2023-10-25',
                'thumbnail_path' => 'https://picsum.photos/seed/project1/800/600',
            ],
            [
                'title' => 'Task Management App',
                'project_category_id' => $categories['Mobile Development']->id,
                'description' => 'A cross-platform mobile application for team collaboration and task management, built using React Native. Features real-time updates with Firebase.',
                'technology_stack' => 'React Native, Firebase, Node.js',
                'github_url' => 'https://github.com',
                'live_demo_url' => 'https://example.com',
                'status' => 'published',
                'featured' => true,
                'client' => 'Startup Inc.',
                'date' => '2024-01-15',
                'thumbnail_path' => 'https://picsum.photos/seed/project2/800/600',
            ],
            [
                'title' => 'Company Branding & Website',
                'project_category_id' => $categories['Branding']->id,
                'description' => 'Complete branding guidelines and a marketing website for a new design agency. Focused on a clean, minimalist aesthetic with smooth animations.',
                'technology_stack' => 'Figma, Illustrator, Tailwind CSS, Alpine.js',
                'github_url' => null,
                'live_demo_url' => 'https://example.com',
                'status' => 'published',
                'featured' => true,
                'client' => 'Creative Co.',
                'date' => '2023-08-01',
                'thumbnail_path' => 'https://picsum.photos/seed/project3/800/600',
            ]
        ];

        foreach ($projects as $project) {
            $project['slug'] = Str::slug($project['title']);
            Project::create($project);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = SkillCategory::all()->keyBy('name');

        $skills = [
            // Frontend
            [
                'name' => 'React',
                'skill_category_id' => $categories['Frontend']->id,
                'logo_path' => 'https://cdn.simpleicons.org/react',
                'percentage' => 95,
                'featured' => true,
            ],
            [
                'name' => 'Vue.js',
                'skill_category_id' => $categories['Frontend']->id,
                'logo_path' => 'https://cdn.simpleicons.org/vuedotjs',
                'percentage' => 90,
                'featured' => true,
            ],
            [
                'name' => 'Tailwind CSS',
                'skill_category_id' => $categories['Frontend']->id,
                'logo_path' => 'https://cdn.simpleicons.org/tailwindcss',
                'percentage' => 98,
                'featured' => true,
            ],
            // Backend
            [
                'name' => 'Laravel',
                'skill_category_id' => $categories['Backend']->id,
                'logo_path' => 'https://cdn.simpleicons.org/laravel',
                'percentage' => 98,
                'featured' => true,
            ],
            [
                'name' => 'Node.js',
                'skill_category_id' => $categories['Backend']->id,
                'logo_path' => 'https://cdn.simpleicons.org/nodedotjs',
                'percentage' => 85,
                'featured' => true,
            ],
            // Database
            [
                'name' => 'MySQL',
                'skill_category_id' => $categories['Database']->id,
                'logo_path' => 'https://cdn.simpleicons.org/mysql',
                'percentage' => 92,
                'featured' => true,
            ],
            // DevOps
            [
                'name' => 'Docker',
                'skill_category_id' => $categories['DevOps']->id,
                'logo_path' => 'https://cdn.simpleicons.org/docker',
                'percentage' => 80,
                'featured' => true,
            ],
            // Cloud
            [
                'name' => 'AWS',
                'skill_category_id' => $categories['Cloud']->id,
                'logo_path' => 'https://cdn.simpleicons.org/amazonwebservices',
                'percentage' => 75,
                'featured' => true,
            ],
            // AI
            [
                'name' => 'TensorFlow',
                'skill_category_id' => $categories['AI']->id,
                'logo_path' => 'https://cdn.simpleicons.org/tensorflow',
                'percentage' => 70,
                'featured' => true,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name']],
                $skill,
            );
        }
    }
}

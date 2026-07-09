<?php

namespace Database\Seeders;

use App\Models\SkillCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SkillCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Frontend',
            'Backend',
            'Database',
            'DevOps',
            'Cloud',
            'AI',
        ];

        foreach ($categories as $category) {
            SkillCategory::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\ProjectCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Web Application',
            'Mobile Development',
            'UI/UX Design',
            'Branding',
        ];

        foreach ($categories as $category) {
            ProjectCategory::firstOrCreate(
                ['name' => $category],
                ['slug' => Str::slug($category)],
            );
        }
    }
}

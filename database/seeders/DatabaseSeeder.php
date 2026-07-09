<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            SkillCategorySeeder::class,
            ProjectCategorySeeder::class,
            HeroSeeder::class,
            AboutSeeder::class,
            SkillSeeder::class,
            ProjectSeeder::class,
            EducationSeeder::class,
            ServiceSeeder::class,
            CertificateSeeder::class,
            ExperienceSeeder::class,
            SocialMediaSeeder::class,
            SettingSeeder::class,
        ]);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $user->assignRole('Admin');
    }
}

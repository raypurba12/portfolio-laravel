<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'institution'    => 'Universitas Gadjah Mada',
                'degree'         => 'Bachelor of Computer Science',
                'field_of_study' => 'Computer Science',
                'description'    => 'Focused on software engineering, algorithm design, and web technologies. Graduated with honors.',
                'start_year'     => 2018,
                'end_year'       => 2022,
                'is_current'     => false,
                'order'          => 1,
            ],
            [
                'institution'    => 'Dicoding Academy',
                'degree'         => 'Front-End Web Developer',
                'field_of_study' => 'Web Development',
                'description'    => 'Intensive bootcamp covering modern JavaScript, React, and responsive design.',
                'start_year'     => 2022,
                'end_year'       => 2023,
                'is_current'     => false,
                'order'          => 2,
            ],
            [
                'institution'    => 'Coursera',
                'degree'         => 'Deep Learning Specialization',
                'field_of_study' => 'Machine Learning',
                'description'    => 'Advanced coursework in neural networks, CNNs, RNNs, and TensorFlow.',
                'start_year'     => 2023,
                'end_year'       => null,
                'is_current'     => true,
                'order'          => 3,
            ],
        ];

        foreach ($items as $item) {
            Education::create($item);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name'            => 'AWS Certified Cloud Practitioner',
                'number'          => 'AWS-CCP-2024-001',
                'issuer'          => 'Amazon Web Services',
                'issued_at'       => '2024-03-15',
                'expiration_date' => '2027-03-15',
                'credential_url'  => 'https://aws.amazon.com/verify',
            ],
            [
                'name'            => 'Google Professional Cloud Architect',
                'number'          => 'GCP-PCA-2024-002',
                'issuer'          => 'Google Cloud',
                'issued_at'       => '2024-06-20',
                'expiration_date' => '2027-06-20',
                'credential_url'  => 'https://google.com/verify',
            ],
            [
                'name'            => 'Laravel Certified Developer',
                'number'          => 'LARAVEL-2024-003',
                'issuer'          => 'Laravel Certification',
                'issued_at'       => '2024-01-10',
                'expiration_date' => null,
                'credential_url'  => 'https://laravel.com/certification',
            ],
        ];

        foreach ($items as $item) {
            Certificate::create($item);
        }
    }
}

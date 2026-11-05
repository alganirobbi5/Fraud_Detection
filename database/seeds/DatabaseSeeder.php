<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Scoring;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // <-- GANTI DENGAN EMAIL AKUN LAMA
        [
             'name' => 'Admin Fraud',
             'password' => Hash::make('password123'), // Pastikan password ini Anda ketahui
             'foto' => 'default.jpg', 
        ]
        );

        // 2. Buat Data Skor Dummy
        $skorData = [
            [
                'city_with_most_claim_amount' => 'Jakarta Pusat',
                'Highest_claim_amount' => 1250000000,
                'highest_diagnosis' => 'Demam Berdarah Dengue',
            ],
            [
                'city_with_most_claim_amount' => 'Surabaya',
                'Highest_claim_amount' => 980000000,
                'highest_diagnosis' => 'Typhoid Fever',
            ],
            [
                'city_with_most_claim_amount' => 'Bandung',
                'Highest_claim_amount' => 760000000,
                'highest_diagnosis' => 'Pneumonia',
            ]
        ];

        foreach ($skorData as $data) {
            Scoring::updateOrCreate(
                ['city_with_most_claim_amount' => $data['city_with_most_claim_amount']],
                $data
            );
        }
    }
}
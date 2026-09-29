<?php

namespace Database\Seeders\users;

use App\Models\Users\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'name' => 'Abdulrahman Reda',
                'email' => 'abdulrahmanreda@gmail.com',
                'gender' => true,
            ],
            [
                'name' => 'Mostafa Khaled',
                'email' => 'mostafakhaled@gmail.com',
                'gender' => true,
            ],
            [
                'name' => 'Mohamed Khaled',
                'email' => 'mohamedkhaled@gmail.com',
                'gender' => true,
            ],
        ];

        foreach ($patients as $patient) {
            Patient::factory()->create($patient);
        }

        Patient::factory(77)->create();
    }
}

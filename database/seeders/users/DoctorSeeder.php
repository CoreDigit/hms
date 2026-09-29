<?php

namespace Database\Seeders\users;

use App\Models\Users\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'Omar Gamal',
                'email' => 'omargamal@gmail.com',
                'gender' => true,
                'specialty' => 'Cardiologist',
                'bio' => 'Dr. Omar Gamal is a dedicated cardiologist committed to providing top-notch cardiovascular care to his patients.',
                'education' => 'He graduated from the University of Chicago Pritzker School of Medicine.',
                'experience' => 'Dr. Gamal has 12 years of experience in diagnosing and treating heart-related conditions.',
            ],
            [
                'name' => 'Hamza Gamal',
                'email' => 'hamzagamal@gmail.com',
                'gender' => true,
                'specialty' => 'Orthopedic Surgeon',
                'bio' => 'Dr. Hamza Gamal is an experienced orthopedic surgeon known for his expertise in joint replacement surgeries.',
                'education' => 'He earned his medical degree from Harvard Medical School.',
                'experience' => 'Dr. Gamal has performed over 500 successful joint replacement surgeries during his career.',
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::factory()->create($doctor);
        }

        Doctor::factory()->count(15)->create();
    }
}

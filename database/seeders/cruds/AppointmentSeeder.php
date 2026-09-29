<?php

namespace Database\Seeders\cruds;

use App\Models\Cruds\Appointment;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        $appointments = [ // 7 -> diagnostics
            [
                'date' => $faker->date,
                'time' => $faker->time,
                'notes' => 'Sick visit',
                'doctor_id' => 1,
                'patient_id' => 1,
                'status' => 'in-progress',
                // diagnostic status: pending
            ],
            [
                'date' => $faker->date,
                'time' => $faker->time,
                'notes' => 'Follow-up visit',
                'doctor_id' => 1,
                'patient_id' => 2,
                'status' => 'in-progress',
                // diagnostic status: in-progress
            ],
            [
                'date' => $faker->date,
                'time' => $faker->time,
                'notes' => 'Immunizations',
                'doctor_id' => 1,
                'patient_id' => 3,
                'status' => 'in-progress',
                // diagnostic status: in-progress
                // lab status: pending
            ],
            [
                'date' => $faker->date,
                'time' => $faker->time,
                'notes' => 'Preventive care',
                'doctor_id' => 1,
                'patient_id' => 4,
                'status' => 'in-progress',
                // diagnostic status: in-progress
                // lab status: completed
            ],
            [
                'date' => $faker->date,
                'time' => $faker->time,
                'notes' => 'Prenatal care',
                'doctor_id' => 1,
                'patient_id' => 5,
                'status' => 'in-progress',
                // diagnostic status: in-progress
                // ray status: pending
            ],
            [
                'date' => $faker->date,
                'time' => $faker->time,
                'notes' => 'Mental health visit',
                'doctor_id' => 1,
                'patient_id' => 6,
                'status' => 'in-progress',
                // diagnostic status: in-progress
                // ray status: completed
            ],
            [
                'date' => $faker->date,
                'time' => $faker->time,
                'notes' => 'Physical exam',
                'doctor_id' => 1,
                'patient_id' => 7,
                'status' => 'completed',
                // diagnostic status: completed
            ],
            [
                'date' => '2023-09-18',
                'notes' => 'Annual checkup',
                'doctor_id' => 1,
                'patient_id' => 8,
                'status' => 'pending',
            ],
        ];

        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }
    }
}

<?php

namespace Database\Seeders\cruds;

use App\Models\Cruds\Diagnostic;
use Illuminate\Database\Seeder;

class DiagnosticSeeder extends Seeder
{
    public function run(): void
    {
        $diagnostics = [
            [
                'doctor_id' => 1,
                'patient_id' => 1,
                'appointment_id' => 1,
                'status' => 'pending',
            ],
            [
                'diagnosis' => 'Flu',
                'medicines' => 'Tamiflu',
                'doctor_id' => 1,
                'patient_id' => 2,
                'appointment_id' => 2,
                're_diagnosis_date' => '2023-10-10',
                'status' => 'in-progress',
                // in-progress because of re_diagnosis_date
            ],
            [
                'doctor_id' => 1,
                'patient_id' => 3,
                'appointment_id' => 3,
                'status' => 'in-progress',
                // in-progress because of redirecting to lab
                // lab status: pending
            ],
            [
                'doctor_id' => 1,
                'patient_id' => 4,
                'appointment_id' => 4,
                'status' => 'in-progress',
                // in-progress because of redirecting to lab
                // lab status: completed
            ],
            [
                'doctor_id' => 1,
                'patient_id' => 5,
                'appointment_id' => 5,
                'status' => 'in-progress',
                // in-progress because of redirecting to ray
                // ray status: pending
            ],
            [
                'doctor_id' => 1,
                'patient_id' => 6,
                'appointment_id' => 6,
                'status' => 'in-progress',
                // in-progress because of redirecting to ray
                // ray status: completed
            ],
            [
                'diagnosis' => 'Pneumonia',
                'medicines' => 'Antibiotics',
                'doctor_id' => 1,
                'patient_id' => 7,
                'appointment_id' => 7,
                'status' => 'completed',
            ],
        ];

        foreach ($diagnostics as $diagnostic) {
            Diagnostic::create($diagnostic);
        }
    }
}

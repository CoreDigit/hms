<?php

namespace Database\Seeders\cruds;

use App\Models\Cruds\Ray;
use Illuminate\Database\Seeder;

class RaySeeder extends Seeder
{
    public function run(): void
    {
        $rays = [
            [
                'description' => "I'm going to need you to get an X-ray of your chest. I'm concerned about your cough and shortness of breath, so I'd like to rule out any lung problems.",
                'diagnostic_id' => 5,
                'status' => 'pending',
            ],
            [
                'description' => "Based on your physical exam, I think it's important to get an X-ray of your ankle to rule out a fracture. I'm concerned that you may have sprained your ankle, but I want to make sure that there is no break in the bone.",
                'diagnosis' => 'This is a clear and concise way for the X-ray employee to communicate the results of the X-ray to the patient. It is also easy for the patient to understand.',
                'diagnostic_id' => 6,
                'ray_employee_id' => 1,
                'status' => 'completed',
            ],
        ];

        foreach ($rays as $ray) {
            Ray::create($ray);
        }
    }
}

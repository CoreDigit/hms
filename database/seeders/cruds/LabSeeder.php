<?php

namespace Database\Seeders\cruds;

use App\Models\Cruds\Lab;
use Illuminate\Database\Seeder;

class LabSeeder extends Seeder
{
    public function run(): void
    {
        $labs = [
            [
                'description' => "I'm going to need you to go to the laboratory to get some blood tests done. I'm concerned about your cholesterol levels, so I'd like you to get a lipid panel. I'd also like you to get a complete blood count (CBC) to check your overall health.",
                'diagnostic_id' => 3,
                'status' => 'pending',
            ],
            [
                'description' => "Based on your symptoms, I think it's important to rule out a possible infection. I'm going to send you to the laboratory to get a urine sample and a blood sample. The urine sample will be tested for bacteria and the blood sample will be tested for white blood cells, which are a sign of infection.",
                'diagnosis' => 'Please provide me with a urine sample in the cup provided.\nNext, I will draw blood from your vein. You may feel a slight pinch.\nThe results should be back within a few days. Your doctor will contact you to discuss the results and recommend any necessary treatment.',
                'diagnostic_id' => 4,
                'lab_employee_id' => 1,
                'status' => 'completed',
            ],
        ];

        foreach ($labs as $lab) {
            Lab::create($lab);
        }
    }
}

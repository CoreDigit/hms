<?php

namespace Database\Seeders\cruds;

use App\Models\Cruds\Ambulance;
use Illuminate\Database\Seeder;

class AmbulanceSeeder extends Seeder
{
    public function run(): void
    {
        Ambulance::factory()->count(10)->create();
    }
}

<?php

namespace Database\Seeders\users;

use App\Models\Users\AmbulanceDriver;
use Illuminate\Database\Seeder;

class AmbulanceDriverSeeder extends Seeder
{
    public function run(): void
    {
        AmbulanceDriver::factory()->count(5)->create();
    }
}

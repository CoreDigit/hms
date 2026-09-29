<?php

namespace Database\Seeders\users;

use App\Models\Users\RayEmployee;
use Illuminate\Database\Seeder;

class RayEmployeeSeeder extends Seeder
{
    public function run(): void
    {
        RayEmployee::factory()->create([
            'name' => 'Eyad Mohamed',
            'email' => 'eyadmohamed@gmail.com',
            'gender' => true,
        ]);

        RayEmployee::factory(5)->create();
    }
}

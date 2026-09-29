<?php

namespace Database\Seeders\users;

use App\Models\Users\LabEmployee;
use Illuminate\Database\Seeder;

class LabEmployeeSeeder extends Seeder
{
    public function run(): void
    {
        LabEmployee::factory()->create([
            'name' => 'Yousef Mohamed',
            'email' => 'yousefmohamed@gmail.com',
            'gender' => true,
        ]);

        LabEmployee::factory(5)->create();
    }
}

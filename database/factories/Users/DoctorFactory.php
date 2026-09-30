<?php

namespace Database\Factories\Users;

use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'gender' => $this->faker->boolean,
            'specialty' => $this->faker->word,
            'department_id' => rand(1, 5),
            'phone' => $this->faker->phoneNumber,
            'bio' => $this->faker->paragraph,
            'education' => $this->faker->paragraph,
            'experience' => $this->faker->paragraph,
        ];
    }
}

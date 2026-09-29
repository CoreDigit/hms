<?php

namespace Database\Factories\users;

use Illuminate\Database\Eloquent\Factories\Factory;

class RayEmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'gender' => $this->faker->boolean,
            'phone' => $this->faker->phoneNumber,
            'bio' => $this->faker->paragraph,
        ];
    }
}

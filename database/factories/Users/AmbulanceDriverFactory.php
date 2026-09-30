<?php

namespace Database\Factories\users;

use Illuminate\Database\Eloquent\Factories\Factory;

class AmbulanceDriverFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'status' => $this->faker->boolean,
            'gender' => $this->faker->boolean,
            'phone' => $this->faker->phoneNumber,
            'license_number' => $this->faker->unique()->randomNumber(6),
            'address' => $this->faker->address,
            'ambulance_id' => rand(1, 5),
        ];
    }
}

<?php

namespace Database\Factories\cruds;

use Illuminate\Database\Eloquent\Factories\Factory;

class AmbulanceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['Ambulance', 'Van']),
            'number' => $this->faker->numerify('#####'),
            'model' => $this->faker->randomElement(['Toyota Hiace', 'Ford Transit', 'Mercedes-Benz Sprinter']),
            'year_made' => $this->faker->numberBetween(2010, 2023),
        ];
    }
}

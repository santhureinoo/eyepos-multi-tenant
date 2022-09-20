<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceOffersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->jobTitle(),
            'price'=> $this->faker->randomFloat(2, 1, 100),
            'outlet_id' => $this->faker->jobTitle(),
        ];
    }
}

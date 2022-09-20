<?php

namespace Database\Factories;

use App\Models\Outlet;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $outlets = Outlet::pluck('id')->toArray();

        return [
            'outlet_id' => $this->faker->randomElement($outlets),
            'first_name'   => $this->faker->firstName(),
            'last_name'    => $this->faker->lastName(),
            'email'        => $this->faker->email(),
            'phone'        => $this->faker->phoneNumber(),
            'gender'       => $this->faker->randomElement(['Male', 'Female', 'Other']),
            'dob'          => $this->faker->date(),
            'company_name' => $this->faker->company(),
            'occupation'   => $this->faker->jobTitle(),
            'insurance'    => $this->faker->company(),
            'reference'    => $this->faker->text,
        ];
    }
}

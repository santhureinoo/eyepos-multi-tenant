<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class OutletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $companies = Company::pluck('id')->toArray();

        return [
            'name' => $this->faker->name(),
            'company_id' => $this->faker->randomElement($companies)
        ];
    }
}

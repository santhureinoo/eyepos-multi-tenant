<?php

namespace Database\Factories;

use App\Models\Outlet;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
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
            'customer_id'  => 1,
            'inventory_id' => 1,
            'value'        => $this->faker->numberBetween(10, 100),
            'gst'          => '7',
            'description'  => $this->faker->text
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\Outlet;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    protected $model = Inventory::class;

    public function definition(): array
    {
        $outlets = Outlet::pluck('id')->toArray();

        return [
            'outlet_id' => $this->faker->randomElement($outlets),
            'category'      => $this->faker->randomElement(['contact_lenses', 'ophthalmic', 'frames', 'sunglasses', 'accessories']),
            'type'          => $this->faker->randomElement(['Dailies', 'Weekly', 'Bi-Weekly', 'Monthly']),
            'supplier_id'   => $this->faker->randomNumber(1, 10),
            'brand_id'      => $this->faker->randomNumber(1, 69),
            'description'   => $this->faker->text,
            'prescription'  => $this->faker->randomElement(['-1.00,-2.25', '-2.50,-1.25', '-']),
            'base_curve'    => $this->faker->randomElement(['8.4', '8.6']),
            'diameter'      => $this->faker->numberBetween(10, 100),
            'quantity'      => $this->faker->randomDigitNotNull,
            'size'          => $this->faker->randomElement(['50', '20', '130']),
            'material'      => $this->faker->randomElement(['Acetate', 'Nylon', 'Titanium', 'Beta Titanium', 'Monel', 'Beryllium', 'Stainless Steel', 'Flexon', 'Aluminum', 'Wood', 'Horn', 'Gold', 'Silver', 'Ultem']),
            'color_frame'   => $this->faker->randomElement(['Silver', 'Gold', 'Bronze', 'Gun', 'Black', 'White', 'Red', 'Green', 'Blue', 'Brown', 'Clear', 'Tortoise', 'Grey', 'Yellow', 'Orange', 'Pink', 'Purple', 'Striped', 'Floral']),
            'color_lens'    => $this->faker->randomElement(['Clear', 'Color', 'Transitions', 'Tinted']),
            'shape'         => $this->faker->randomElement(['Round', 'Rectangle', 'Oval', 'Square', 'Cat', 'Eyes', 'Brow', 'Line', 'Aviator', 'Over', 'Sized', 'Geometric', 'Heart']),
            'price_cost'    => $this->faker->numberBetween(10, 100),
            'price_selling' => $this->faker->numberBetween(30, 300),
            'consignment'   => $this->faker->boolean,
            'purchase_at'   => $this->faker->dateTime,
            'soldout_at'    => $this->faker->dateTime
        ];
    }
}

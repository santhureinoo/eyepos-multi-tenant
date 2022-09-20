<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Contact Lens',
                'Ophthalmic Lens',
                'Frames',
                'Sunglasses',
                'Accessories'
            ])
        ];
    }
}

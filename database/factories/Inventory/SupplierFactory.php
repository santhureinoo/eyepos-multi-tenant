<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Luxottica',
                'Safilo',
                'Kering',
                'Marchon',
                'Marcolin',
                'U Vision',
                'Titanium',
                'Ah Nam',
                'Sunrise',
                'Viz Global'
            ])
        ];
    }
}

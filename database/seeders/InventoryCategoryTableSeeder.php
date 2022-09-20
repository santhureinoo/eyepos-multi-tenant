<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Seeder;

class InventoryCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $outlets = Outlet::pluck('id')->toArray();

        foreach ($outlets as $outlet_id) {
            \App\Models\Inventory\Category::factory(1)->create(['name' => 'Dailies', 'outlet_id' => $outlet_id]);
            \App\Models\Inventory\Category::factory(1)->create(['name' => 'Contact Lenses', 'outlet_id' => $outlet_id]);
            \App\Models\Inventory\Category::factory(1)->create(['name' => 'PAL', 'outlet_id' => $outlet_id]);
            \App\Models\Inventory\Category::factory(1)->create(['name' => 'Frames', 'outlet_id' => $outlet_id]);
            \App\Models\Inventory\Category::factory(1)->create(['name' => 'Sunglasses', 'outlet_id' => $outlet_id]);
            \App\Models\Inventory\Category::factory(1)->create(['name' => 'Accessories', 'outlet_id' => $outlet_id]);
        }
    }
}

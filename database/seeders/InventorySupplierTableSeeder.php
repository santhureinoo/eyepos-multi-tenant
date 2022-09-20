<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Seeder;

class InventorySupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
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
        ];

        $outlets = Outlet::pluck('id')->toArray();

        foreach ($suppliers as $supplier) {
            foreach ($outlets as $outlet_id) {
                \App\Models\Inventory\Supplier::factory(1)->create(['name' => $supplier, 'outlet_id' => $outlet_id]);
            }
        }
    }
}

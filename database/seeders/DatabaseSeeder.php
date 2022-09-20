<?php

namespace Database\Seeders;

use App\Models\ServiceOffers;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Customers;
use App\Models\Company;
use App\Models\Order;
use App\Models\Outlet;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        Company::factory(3)->create();
        Outlet::factory(3)->create();
        User::factory(3)->create();

        $this->call([
            InventoryBrandTableSeeder::class,
            InventorySupplierTableSeeder::class,
            InventoryCategoryTableSeeder::class,
            ServiceOffersTableSeeder::class,
            // RolesAndPermissionsTableSeeder:: class
        ]);

        DB::table('configs')->insert([
            'key'   => 'setup.financials.gst',
            'value' => 'SGD'
        ]);

        // User::factory(3)->withTestEmail()->create();
        Inventory::factory(10)->create();
        Customers::factory(10)->create();
        // Order::factory(10)->create();
    }
}

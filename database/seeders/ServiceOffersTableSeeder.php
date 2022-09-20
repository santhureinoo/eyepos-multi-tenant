<?php

namespace Database\Seeders;

use App\Models\Outlet;
use App\Models\ServiceOffers;
use Illuminate\Database\Seeder;

class ServiceOffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            'Refraction Test',
            'Eye Health Examination',
            'Contact Lens Fitting'
        ];

        $outlets = Outlet::pluck('id')->toArray();

        foreach ($services as $service) {
            foreach ($outlets as $outlet) {
                ServiceOffers::factory(1)->create(['name' => $service, 'outlet_id' => $outlet]);
            }
        }
    }
}

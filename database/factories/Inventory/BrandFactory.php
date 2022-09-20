<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Rayban',
                'Oakley',
                'Giorgio Armani',
                'Emporio Armani',
                'AX',
                'Burberry',
                'D&G',
                'Coach',
                'Tiffany',
                'Prada',
                'Miu Miu',
                'Vogue',
                'Alain Mikli',
                'Olivier Peoples',
                'Starck',
                'Michael Kors',
                'Bvlgari (Luxottica)',
                'Hugo Boss',
                'Carrera',
                'Fossil',
                'Havaianas',
                'Jimmy Choo',
                'Kate Spade',
                'Levis',
                'Marc Jacobs',
                'Moschino',
                'Pierre Cardin',
                'Polaroid',
                'Tommy Hilfiger',
                'Under Armour (Safilo)',
                'Gucci',
                'Saint Laurent',
                'Bottega Veneta',
                'Balenciaga',
                'Alexander McQueen',
                'Cartier (Kering)',
                'Calvin Klein',
                'DKNY',
                'Lanvin',
                'Nike',
                'Longchamp',
                'Nine West',
                'Victoria Beckham',
                'Paul Smith',
                'Converse',
                'MCM',
                'Cutler & Gross',
                'Lasocte',
                'Nautica',
                'Ferragamo (Marchon)',
                'Adidas',
                'Bally',
                'Barton Perreira',
                'BMW',
                'Emilio Pucci',
                'Zegna',
                'Gant',
                'Guess',
                'Harley Davidson',
                'Kenneth Cole',
                'Longines',
                'Max Mara',
                'Max & Co',
                'Omega',
                'Sketchers',
                'Swarovski',
                'Tom Ford',
                'Tods (Marcolin)',
                'Valentino Rudy (Viz Global)'
            ])
        ];
    }
}

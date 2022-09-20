<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OcularFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id'           => 1,
            'pupillary_reflex'      => '(-) RAPD',
            'eyelids'               => 'No abnormalities detected',
            'tear_film'             => '',
            'conjunctiva'           => 'No abnormalities detected',
            'cornea'                => 'No abnormalities detected',
            'iris'                  => 'No abnormalities detected',
            'crystalline_lens'      => 'No abnormalities detected',
            'retinal_blood_vessels' => '2:3',
            'optic_nerve'           => 'OU 0.4/0.5',
            'macula'                => 'Flat and dry',
            'retina_posterior_pole' => 'No abnormalities detected',
        ];
    }
}

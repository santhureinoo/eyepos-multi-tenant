<?php

namespace Database\Factories;

use App\Models\Outlet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
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
            'name' => $this->faker->name(),
            'outlet_id' => $this->faker->randomElement($outlets),
            'email' => $this->faker->unique()->randomElement(['test@test.com', 'test1@test.com', 'test2@test.com']),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Create with email test@test.com.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withTestEmail()
    {
        return $this->state(function (array $attributes) {
            return [
                // 'email' => 'test@test.com',
                'email' => $this->faker->randomElement(['test@test.com', 'test1@test.com', 'test2@test.com']),
            ];
        });
    }
}

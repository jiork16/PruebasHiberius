<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'vehicle_id' => mt_rand(1, 10),
            'driver_id' => mt_rand(1, 10),
            'date' => $this->faker->dateTimeInInterval('-1 week', '+3 days')
        ];
    }
}

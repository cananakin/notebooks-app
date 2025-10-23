<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instrument>
 */
class InstrumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku'        => $this->faker->unique()->bothify('BI-???-20##'),
            'name'       => $this->faker->words(2, true),
            'region'     => $this->faker->randomElement(['Bordeaux','Piedmont','Burgundy']),
            'vintage'    => $this->faker->numberBetween(2000, 2020),
            'tick_size'  => $this->faker->randomElement([0.25,0.50,1.00]),
            'last_price' => null,
        ];
    }
}

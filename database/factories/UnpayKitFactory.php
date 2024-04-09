<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UnpayKit>
 */
class UNpayKitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kit_number' => $this->faker->randomNumber(9, true),
            'user_id' => null,
            'statut' => 'En stock',
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Supplier>
 */
class SupplierFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'contact_person' => fake()->name(),
            'email' => fake()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'description' => fake()->optional()->sentence(),
            'bank_name' => fake()->randomElement(['BCA', 'BNI', 'BRI', 'Mandiri', 'CIMB Niaga']),
            'bank_account_number' => fake()->numerify('##########'),
            'bank_account_name' => fake()->name(),
            'payment_terms' => fake()->randomElement(['Net 30', 'Net 60', 'COD', 'Net 14']),
            'credit_limit' => fake()->optional()->randomFloat(2, 1000000, 100000000),
            'tax_id' => fake()->optional()->numerify('##.###.###.#-###.###'),
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}

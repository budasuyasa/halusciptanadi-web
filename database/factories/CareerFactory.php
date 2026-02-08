<?php

namespace Database\Factories;

use App\Enums\EmploymentType;
use App\Models\Career;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Career>
 */
class CareerFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->unique()->jobTitle();

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'location' => fake()->randomElement(['Denpasar', 'Singaraja', 'Negara']),
            'employment_type' => fake()->randomElement(EmploymentType::cases()),
            'department' => fake()->randomElement(['Sales', 'Warehouse', 'Finance', 'Marketing', 'Operations']),
            'description' => fake()->paragraphs(3, true),
            'requirements' => fake()->paragraphs(2, true),
            'benefits' => fake()->paragraphs(1, true),
            'salary_range' => 'Rp ' . fake()->numberBetween(3, 8) . '.000.000 - Rp ' . fake()->numberBetween(8, 15) . '.000.000',
            'is_active' => true,
            'application_deadline' => fake()->dateTimeBetween('now', '+3 months'),
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}

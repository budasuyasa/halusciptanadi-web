<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_number' => Order::generateOrderNumber(),
            'customer_name' => fake()->name(),
            'customer_email' => fake()->safeEmail(),
            'customer_phone' => fake()->phoneNumber(),
            'shipping_address' => fake()->address(),
            'shipping_city' => fake()->city(),
            'shipping_province' => 'Bali',
            'shipping_postal_code' => fake()->postcode(),
            'notes' => fake()->optional()->sentence(),
            'subtotal' => 0,
            'shipping_cost' => 0,
            'total' => 0,
            'status' => OrderStatus::Pending,
            'payment_method' => null,
            'payment_status' => PaymentStatus::Unpaid,
        ];
    }

    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => OrderStatus::Processing,
            'payment_status' => PaymentStatus::Paid,
            'payment_method' => 'va_bca',
            'paid_at' => now(),
        ]);
    }
}

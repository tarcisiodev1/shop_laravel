<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{

    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customer = Customer::factory()->create();

        return [
            'customer_id' => $customer->id,
            'total' => $this->faker->randomFloat(2, 10, 500),
            'forma_de_pagamento' => $this->faker->randomElement(['PIX', 'BOLETO', 'CARTAO_DE_CREDITO']),
        ];
    }
}

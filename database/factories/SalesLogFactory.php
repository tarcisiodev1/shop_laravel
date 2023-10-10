<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\SalesLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesLog>
 */
class SalesLogFactory extends Factory
{
    protected $model = SalesLog::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order = Order::factory()->create();

        return [
            'order_id' => $order->id,
            'status' => $this->faker->randomElement(['Aprovado', 'Pendente', 'Cancelado']),
        ];
    }
}

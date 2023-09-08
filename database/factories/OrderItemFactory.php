<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order = Order::factory()->create();
        $product = Product::factory()->create();

        $quantity = $this->faker->numberBetween(1, 5);
        $subtotal = $product->valor * $quantity;

        return [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantidade' => $quantity,
            'subtotal' => $subtotal,
        ];
    }
}

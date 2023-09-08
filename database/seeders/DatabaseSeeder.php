<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentSetting;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SalesLog;
use App\Models\ShippingSetting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Crie produtos e suas imagens
        Product::factory()->count(10)->create()->each(function ($product) {
            ProductImage::factory()->count(3)->create(['product_id' => $product->id]);
        });

        // Crie clientes
        Customer::factory()->count(20)->create();

        // Crie pedidos
        $customers = Customer::all();
        $customers->each(function ($customer) {
            $order = Order::factory()->create(['customer_id' => $customer->id]);

            // Crie itens do pedido
            $products = Product::inRandomOrder()->limit(5)->get();
            foreach ($products as $product) {
                $quantity = rand(1, 5);
                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantidade' => $quantity,
                    'subtotal' => $product->valor * $quantity,
                ]);
            }

            // Crie registros de log de venda
            SalesLog::factory()->create(['order_id' => $order->id]);

            // Crie configurações de frete para produtos
            $products->each(function ($product) {
                ShippingSetting::factory()->create(['product_id' => $product->id]);
            });

            // Crie configurações de pagamento
            PaymentSetting::factory()->count(3)->create();
        });
    }
}

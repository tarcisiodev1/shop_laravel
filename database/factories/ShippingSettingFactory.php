<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ShippingSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShippingSetting>
 */
class ShippingSettingFactory extends Factory
{

    protected $model = ShippingSetting::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::factory()->create();

        return [
            'product_id' => $product->id,
            'cep_origem' => $this->faker->numerify('########'), // Gera um CEP aleatório
            'informacoes_frete' => $this->faker->text,
        ];
    }
}

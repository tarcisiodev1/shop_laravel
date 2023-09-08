<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->sentence,
            'valor' => $this->faker->randomFloat(2, 10, 500),
            'dimensoes' => $this->faker->randomElement(['Pequeno', 'Médio', 'Grande']),
            'peso' => $this->faker->randomFloat(2, 0.1, 50),
        ];
    }
}

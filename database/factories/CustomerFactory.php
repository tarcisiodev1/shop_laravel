<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome_completo' => $this->faker->name,
            'cpf' => $this->faker->unique()->numerify('###########'), // Gera um CPF aleatório válido
            'nascimento' => $this->faker->date,
            'endereco' => $this->faker->address,
            'cep' => $this->faker->numerify('########'), // Gera um CEP aleatório
        ];
    }
}

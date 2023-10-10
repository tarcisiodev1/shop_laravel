<?php

namespace Database\Factories;

use App\Models\PaymentSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentSetting>
 */
class PaymentSettingFactory extends Factory
{

    protected $model = PaymentSetting::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'method' => $this->faker->randomElement(['PIX', 'BOLETO', 'CARTAO_DE_CREDITO']),
            'informacoes_necessarias' => $this->faker->text,
        ];
    }
}

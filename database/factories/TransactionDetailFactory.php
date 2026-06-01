<?php

namespace Database\Factories;

use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TransactionDetail>
 */
class TransactionDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaction_id' => \App\Models\Transaction::factory(),
            'product_id' => \App\Models\Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'price_at_transaction' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}

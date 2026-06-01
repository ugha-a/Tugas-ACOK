<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'supplier_id' => null,
            'type' => $this->faker->randomElement(['in', 'out']),
            'reference_number' => 'TRX-'.$this->faker->date('Ymd').'-'.$this->faker->unique()->numerify('###0'),
            'transaction_date' => $this->faker->date(),
            'destination' => null,
            'total_items' => 0,
        ];
    }
}

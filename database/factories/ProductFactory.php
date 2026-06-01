<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => \App\Models\Category::factory(),
            'supplier_id' => \App\Models\Supplier::factory(),
            'code' => strtoupper($this->faker->unique()->bothify('SKU-####')),
            'name' => $this->faker->words(2, true),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'stock' => $this->faker->numberBetween(0, 200),
            'min_stock' => $this->faker->numberBetween(5, 20),
        ];
    }
}

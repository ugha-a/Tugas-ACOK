<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Transaction;
use App\Services\StockMovementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockMovementServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_stock_increases_on_process_in()
    {
        $product = Product::factory()->create(['stock' => 5]);

        $trx = Transaction::factory()->create(['type' => 'in']);

        $service = new StockMovementService();
        $service->process($trx, [
            ['product_id' => $product->id, 'quantity' => 4, 'price_at_transaction' => $product->price],
        ]);

        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 9]);
    }

    public function test_stock_decreases_on_process_out()
    {
        $product = Product::factory()->create(['stock' => 10]);
        $trx = Transaction::factory()->create(['type' => 'out']);

        $service = new StockMovementService();
        $service->process($trx, [
            ['product_id' => $product->id, 'quantity' => 3, 'price_at_transaction' => $product->price],
        ]);

        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 7]);
    }

    public function test_stock_out_throws_when_insufficient()
    {
        $this->expectException(\RuntimeException::class);

        $product = Product::factory()->create(['stock' => 2]);
        $trx = Transaction::factory()->create(['type' => 'out']);

        $service = new StockMovementService();
        $service->process($trx, [
            ['product_id' => $product->id, 'quantity' => 5, 'price_at_transaction' => $product->price],
        ]);
    }
}

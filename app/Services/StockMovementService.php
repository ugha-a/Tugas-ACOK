<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class StockMovementService
{
    /**
     * Process stock movement for a transaction.
     *
     * @param Transaction $transaction
     * @param array|Collection $lines  Each line: ['product_id' => int, 'quantity' => int, 'price_at_transaction' => string]
     * @throws \Throwable
     */
    public function process(Transaction $transaction, $lines): void
    {
        $lines = $lines instanceof Collection ? $lines : collect($lines);

        DB::beginTransaction();
        try {
            if ($transaction->type === 'in') {
                $this->processIn($lines);
            } elseif ($transaction->type === 'out') {
                $this->processOut($lines);
            } else {
                throw new InvalidArgumentException('Invalid transaction type');
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function processIn(Collection $lines): void
    {
        foreach ($lines as $line) {
            $product = Product::lockForUpdate()->findOrFail($line['product_id']);
            $add = (int) $line['quantity'];
            $product->stock = $product->stock + $add;
            $product->save();
        }
    }

    protected function processOut(Collection $lines): void
    {
        foreach ($lines as $line) {
            $product = Product::lockForUpdate()->findOrFail($line['product_id']);
            $qty = (int) $line['quantity'];
            if ($qty > $product->stock) {
                throw new \RuntimeException("Stok tidak mencukupi untuk produk {$product->id}");
            }
            $product->stock = $product->stock - $qty;
            $product->save();
        }
    }
}

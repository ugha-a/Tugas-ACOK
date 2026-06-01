<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.test',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Staff User',
            'email' => 'staff@example.test',
            'role' => 'staff',
        ]);

        // Categories & Suppliers
        $categories = Category::factory()->count(3)->create();
        $suppliers = Supplier::factory()->count(3)->create();

        // Products
        Product::factory()->count(10)->create()->each(function (Product $p) use ($suppliers, $categories) {
            $p->category_id = $categories->random()->id;
            $p->supplier_id = $suppliers->random()->id;
            $p->save();
        });

        // Simple transactions
        $user = User::first();
        $product = Product::first();

        $trx = Transaction::create([
            'user_id' => $user->id,
            'supplier_id' => $product->supplier_id,
            'type' => 'in',
            'reference_number' => 'TRX-'.now()->format('Ymd').'-0001',
            'transaction_date' => now()->toDateString(),
            'total_items' => 1,
        ]);

        TransactionDetail::create([
            'transaction_id' => $trx->id,
            'product_id' => $product->id,
            'quantity' => 10,
            'price_at_transaction' => $product->price,
        ]);
    }
}

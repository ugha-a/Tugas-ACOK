<?php

namespace App\Livewire\Transaction;

use App\Http\Forms\TransactionForm as TransactionFormObject;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Services\StockMovementService;
use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Out extends Component
{
    public array $form = [];

    public function mount()
    {
        $this->form = [
            'type' => 'out',
            'supplier_id' => null,
            'destination' => null,
            'transaction_date' => now()->toDateString(),
            'lines' => [],
        ];
    }

    public function addLine()
    {
        $this->form['lines'][] = ['product_id' => null, 'quantity' => 1, 'price_at_transaction' => 0];
    }

    public function removeLine($index)
    {
        unset($this->form['lines'][$index]);
        $this->form['lines'] = array_values($this->form['lines']);
    }

    public function save()
    {
        if (! Auth::check()) abort(403);

        $formObject = new TransactionFormObject();
        $formObject->type = 'out';
        $rules = $formObject->rules();
        \Illuminate\Support\Facades\Validator::make($this->form, $rules)->validate();

        DB::beginTransaction();
        try {
            $trx = Transaction::create([
                'user_id' => Auth::id(),
                'supplier_id' => null,
                'type' => 'out',
                'reference_number' => 'TRX-'.now()->format('Ymd').'-'.mt_rand(1000,9999),
                'transaction_date' => $this->form['transaction_date'],
                'destination' => $this->form['destination'],
                'total_items' => array_sum(array_column($this->form['lines'], 'quantity')),
            ]);

            foreach ($this->form['lines'] as $line) {
                TransactionDetail::create([
                    'transaction_id' => $trx->id,
                    'product_id' => $line['product_id'],
                    'quantity' => $line['quantity'],
                    'price_at_transaction' => $line['price_at_transaction'] ?? 0,
                ]);
            }

            app(StockMovementService::class)->process($trx, $this->form['lines']);

            DB::commit();

            $this->emit('transactionSaved');
            $this->form = [
                'type' => 'out',
                'supplier_id' => null,
                'destination' => null,
                'transaction_date' => now()->toDateString(),
                'lines' => [],
            ];
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->addError('save', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.transaction.out')->layout('layouts.app');
    }
}

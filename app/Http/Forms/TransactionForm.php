<?php

namespace App\Http\Forms;

class TransactionForm
{
    public string $type = 'in';
    public ?int $supplier_id = null;
    public ?string $destination = null;
    public string $transaction_date;
    public array $lines = [];

    public function __construct()
    {
        $this->transaction_date = now()->toDateString();
        $this->lines = [];
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'in:in,out'],
            'supplier_id' => $this->type === 'in' ? ['required','integer','exists:suppliers,id'] : ['nullable','integer','exists:suppliers,id'],
            'destination' => $this->type === 'out' ? ['required','string','max:255'] : ['nullable','string','max:255'],
            'transaction_date' => ['required','date'],
            'lines' => ['required','array','min:1'],
            'lines.*.product_id' => ['required','integer','exists:products,id'],
            'lines.*.quantity' => ['required','integer','min:1'],
        ];
    }
}

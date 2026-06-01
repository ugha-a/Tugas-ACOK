<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use App\Models\Transaction;

class Index extends Component
{
    public $search = '';

    public function render()
    {
        $query = Transaction::with(['details.product', 'supplier', 'user'])->latest();
        if ($this->search) {
            $query->where('reference_number', 'like', "%{$this->search}%");
        }

        $transactions = $query->paginate(12);

        return view('livewire.transaction.index', compact('transactions'));
    }
}

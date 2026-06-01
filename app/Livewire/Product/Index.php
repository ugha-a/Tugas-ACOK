<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $search = '';

    protected $listeners = ['productSaved' => '$refresh'];

    public function delete(int $id)
    {
        if (! Auth::check() || ! Auth::user()->isAdmin()) {
            abort(403);
        }

        Product::findOrFail($id)->delete();
        $this->emitSelf('productSaved');
    }

    public function render()
    {
        $query = Product::with(['category','supplier'])->latest();
        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")->orWhere('code', 'like', "%{$this->search}%");
        }

        $products = $query->paginate(12);

        return view('livewire.product.index', compact('products'))->layout('layouts.app');
    }
}

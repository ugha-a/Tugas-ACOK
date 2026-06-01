<?php

namespace App\Livewire\Product;

use App\Http\Forms\ProductForm as ProductFormObject;
use App\Models\Product;
use Livewire\Component;

use Illuminate\Support\Facades\Gate;

class Form extends Component
{
    public array $form = [];

    public bool $isEdit = false;

    protected $listeners = ['editProduct' => 'loadForEdit'];

    public function mount()
    {
        $this->resetForm();
    }

    public function loadForEdit(int $id)
    {
        $product = Product::findOrFail($id);
        $this->isEdit = true;
        $this->form = [
            'id' => $product->id,
            'category_id' => $product->category_id,
            'supplier_id' => $product->supplier_id,
            'code' => $product->code,
            'name' => $product->name,
            'price' => (float) $product->price,
            'stock' => $product->stock,
            'min_stock' => $product->min_stock,
        ];
    }

    public function save()
    {
        if (! auth()->user() || ! auth()->user()->isAdmin()) {
            abort(403);
        }

        // Build a temporary form object to get validation rules (handles unique rule with id)
        $formObject = new ProductFormObject();
        $formObject->id = $this->form['id'] ?? null;
        $formObject->category_id = $this->form['category_id'] ?? null;
        $formObject->supplier_id = $this->form['supplier_id'] ?? null;
        $formObject->code = $this->form['code'] ?? '';
        $formObject->name = $this->form['name'] ?? '';
        $formObject->price = $this->form['price'] ?? 0;
        $formObject->stock = $this->form['stock'] ?? 0;
        $formObject->min_stock = $this->form['min_stock'] ?? 10;

        $this->validate($formObject->rules());

        $data = [
            'category_id' => $this->form['category_id'] ?? null,
            'supplier_id' => $this->form['supplier_id'] ?? null,
            'code' => $this->form['code'] ?? '',
            'name' => $this->form['name'] ?? '',
            'price' => $this->form['price'] ?? 0,
            'stock' => $this->form['stock'] ?? 0,
            'min_stock' => $this->form['min_stock'] ?? 10,
        ];

        if ($this->isEdit && ($this->form['id'] ?? null)) {
            Product::findOrFail($this->form['id'])->update($data);
        } else {
            Product::create($data);
        }

        $this->dispatch('productSaved');
        $this->resetForm();
    }

    protected function resetForm()
    {
        $this->form = [
            'id' => null,
            'category_id' => null,
            'supplier_id' => null,
            'code' => '',
            'name' => '',
            'price' => 0,
            'stock' => 0,
            'min_stock' => 10,
        ];
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.product.form')->layout('layouts.app');
    }
}

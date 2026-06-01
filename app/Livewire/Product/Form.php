<?php

namespace App\Livewire\Product;

use App\Http\Forms\ProductForm as ProductFormObject;
use App\Models\Product;
use Livewire\Component;

use Illuminate\Support\Facades\Gate;

class Form extends Component
{
    public ProductFormObject $form;

    public bool $isEdit = false;

    protected $listeners = ['editProduct' => 'loadForEdit'];

    public function mount()
    {
        $this->form = new ProductFormObject();
    }

    public function loadForEdit(int $id)
    {
        $product = Product::findOrFail($id);
        $this->isEdit = true;
        $this->form->id = $product->id;
        $this->form->category_id = $product->category_id;
        $this->form->supplier_id = $product->supplier_id;
        $this->form->code = $product->code;
        $this->form->name = $product->name;
        $this->form->price = (float) $product->price;
        $this->form->stock = $product->stock;
        $this->form->min_stock = $product->min_stock;
    }

    public function save()
    {
        if (! auth()->user() || ! auth()->user()->isAdmin()) {
            abort(403);
        }

        $this->validate($this->form->rules());

        $data = [
            'category_id' => $this->form->category_id,
            'supplier_id' => $this->form->supplier_id,
            'code' => $this->form->code,
            'name' => $this->form->name,
            'price' => $this->form->price,
            'stock' => $this->form->stock,
            'min_stock' => $this->form->min_stock,
        ];

        if ($this->isEdit && $this->form->id) {
            Product::findOrFail($this->form->id)->update($data);
        } else {
            Product::create($data);
        }

        $this->emit('productSaved');
        $this->resetForm();
    }

    protected function resetForm()
    {
        $this->form = new ProductFormObject();
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.product.form');
    }
}

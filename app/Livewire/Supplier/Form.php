<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Form extends Component
{
    public $name = '';
    public $address = '';
    public $phone = '';
    public $email = '';
    public $isEdit = false;
    public $editId = null;
    public $open = false;

    protected $listeners = ['editSupplier' => 'loadForEdit', 'openSupplierForm' => 'open'];

    public function loadForEdit($id)
    {
        $s = Supplier::findOrFail($id);
        $this->editId = $s->id;
        $this->name = $s->name;
        $this->address = $s->address;
        $this->phone = $s->phone;
        $this->email = $s->email;
        $this->isEdit = true;
        $this->open = true;
    }

    public function open($id = null)
    {
        if ($id) {
            $this->loadForEdit($id);
            return;
        }
        $this->resetForm();
        $this->open = true;
    }

    public function save()
    {
        if (! Auth::check() || ! Auth::user()->isAdmin()) abort(403);

        $data = $this->validate([
            'name' => 'required|string|max:191',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:191',
        ]);

        if ($this->isEdit && $this->editId) {
            Supplier::findOrFail($this->editId)->update($data);
        } else {
            Supplier::create($data);
        }

        $this->dispatch('supplierSaved');
        $this->resetForm();
        $this->open = false;
    }

    protected function resetForm()
    {
        $this->name = '';
        $this->address = '';
        $this->phone = '';
        $this->email = '';
        $this->isEdit = false;
        $this->editId = null;
    }

    public function render()
    {
        return view('livewire.supplier.form');
    }
}

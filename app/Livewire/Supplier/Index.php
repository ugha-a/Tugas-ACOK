<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $search = '';

    protected $listeners = ['supplierSaved' => '$refresh'];

    public function delete(int $id)
    {
        if (! Auth::check() || ! Auth::user()->isAdmin()) abort(403);
        Supplier::findOrFail($id)->delete();
        $this->dispatch('supplierSaved');
    }

    public function openForm($id = null)
    {
        $this->dispatch('openSupplierForm', $id);
    }

    public function render()
    {
        $query = Supplier::query();
        if ($this->search) $query->where('name', 'like', "%{$this->search}%");
        $suppliers = $query->orderBy('name')->paginate(12);
        return view('livewire.supplier.index', compact('suppliers'))->layout('layouts.app');
    }
}

<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $search = '';

    protected $listeners = ['categorySaved' => '$refresh'];

    public function delete(int $id)
    {
        if (! Auth::check() || ! Auth::user()->isAdmin()) abort(403);
        Category::findOrFail($id)->delete();
        $this->emitSelf('categorySaved');
    }

    public function render()
    {
        $query = Category::query();
        if ($this->search) $query->where('name', 'like', "%{$this->search}%");
        $categories = $query->orderBy('name')->paginate(12);
        return view('livewire.category.index', compact('categories'))->layout('layouts.app');
    }
}

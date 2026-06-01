<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class Form extends Component
{
    public $open = false;
    public $name = '';
    public $slug = '';
    public $isEdit = false;
    public $editId = null;

    protected $listeners = ['editCategory' => 'loadForEdit', 'openCategoryForm' => 'open'];

    public function loadForEdit($id)
    {
        $c = Category::findOrFail($id);
        $this->editId = $c->id;
        $this->name = $c->name;
        $this->slug = $c->slug;
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
            'slug' => 'nullable|string|max:191',
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        if ($this->isEdit && $this->editId) {
            Category::findOrFail($this->editId)->update($data);
        } else {
            Category::create($data);
        }

        $this->dispatch('categorySaved');
        $this->resetForm();
        $this->open = false;
    }

    protected function resetForm()
    {
        $this->name = '';
        $this->slug = '';
        $this->isEdit = false;
        $this->editId = null;
    }

    public function render()
    {
        return view('livewire.category.form');
    }
}

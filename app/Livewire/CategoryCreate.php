<?php

namespace App\Livewire;

use App\Models\category;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
class CategoryCreate extends Component
{
    #[Rule('required|max:250|min:3')]
    public $name;
    public function render()
    {
        return view('livewire.category-create');
    }
    public function save()
    {   
        $validated = $this->validate();
        
        $category =  category::create($validated);
        $this->reset(
            "name",
        );
        session()->flash('category_create', 'New category Added');
        $categorys = Category::get();
        $this->dispatch('category_index', $categorys);
    }
}

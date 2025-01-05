<?php

namespace App\Livewire;

use App\Models\category;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
class CategoryEdit extends Component
{

    public $id;
    #[Rule('required|max:250')]
    public $name;

    public function mount(int $id)
    {
        $this->id = $id;
        $category = Category::findOrFail($id);
        $this->name = $category->name;
    }
    #[Layout('layouts.guest')]
    public function render()
    {
       
        return view('livewire.category-edit');
    }
    public function update()
    {
        $validated = $this->validate();
        $category = Category::findOrFail($this->id);
        $category->update($validated);
        $this->id = '';
        session()->flash('category_index', 'category updated successfully.');
        $categorys = Category::get();
        $this->dispatch('category_index', $categorys);
        $notification = array(
            'message' => 'category updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('welcome')->with($notification);
    }
}

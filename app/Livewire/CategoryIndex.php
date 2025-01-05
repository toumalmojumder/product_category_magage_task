<?php

namespace App\Livewire;

use App\Models\category;
use Livewire\Component;
use Livewire\Attributes\On;

class CategoryIndex extends Component
{
    public $isEditModalOpen = false;
    public $editingCategoryId;
    #[On("category_index")]
    public function render()
    {
        $categorys = category::get();
        
        return view('livewire.category-index',compact('categorys'));
    }
    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        session()->flash('category_index', 'Category deleted successfully');
        $this->dispatch('category_index');
    }
    public function edit($id)
    {
        $this->editingCategoryId = $id; // Pass this ID to the modal or other logic
        $this->isEditModalOpen = true;
    }
    public function closeEditModal()
    {
        $this->isEditModalOpen = false;
        $this->editingCategoryId = null;
    }

}

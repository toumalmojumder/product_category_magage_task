<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Features\SupportFileUploads\WithFileUploads;
class ProductCreate extends Component
{
    use WithFileUploads;
    #[Rule('required')]
    public $category_id;
    #[Rule('required|min:0|max:100000')]
    public $price;
    public function render()
    {
        return view('livewire.product-create');
    }
}

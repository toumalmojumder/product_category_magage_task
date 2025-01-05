<?php

namespace App\Livewire;

use App\Models\category_product;
use App\Models\product;
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
    #[Rule('required|min:3|max:250')]
    public $name;
    #[Rule('required|min:0|max:100000')]
    public $price;
    #[Rule('nullable|sometimes|file|image|max:1024')] // 1MB Max
    public $image;
    public function render()
    {
        $categorys = Category::get();
        return view('livewire.product-create', compact('categorys'));
    }
    public function save()
    {
        $validated = $this->validate();

        if (($this->image)) {
            $validated['image'] = $this->image->store('image', 'public');
        }
        $product = product::create([
            'name' => $this->name,
            'price' => $this->price,
            'image' => $validated['image'],
        ]);
        if ($this->category_id) {
            foreach ($this->category_id as $category_id) {
                category_product::create([
                    'category_id' => $category_id,
                    'product_id' => $product->id,
                ]);
            }
        }
        $this->reset(
            "name",
            "price",
            "image",
        );
        session()->flash('product_create', 'New Product Added');
        $products = product::get();
        $this->dispatch('product_index', $products);
    }
}

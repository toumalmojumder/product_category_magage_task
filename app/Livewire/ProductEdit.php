<?php

namespace App\Livewire;

use App\Models\product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
class ProductEdit extends Component
{
    use WithFileUploads;
    public $id;
    public $oldImage;
    public $category_id;
    #[Rule('required|min:3|max:250')]
    public $name;
    #[Rule('required|min:0|max:100000')]
    public $price;
    #[Rule('nullable|sometimes|file|image|max:1024')] // 1MB Max
    public $image;

    public function mount(int $id){
        $this->id = $id;
        $product = product::findOrFail($id);
        $this->name = $product->name;
        $this->price = $product->price;
        $this->oldImage = $product->image;
       
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.product-edit');
    }
    public function update(){
        $validated = $this->validate();
        $product = Product::findOrFail($this->id);
        if($this->banner){
            try {
                unlink(storage_path('app/public/' . $this->oldImage));                         
                $validated['image'] = $this->image->store('image','public');
                } catch (\Exception $e) {             
                     $validated['image'] = $this->image->store('image','public');
                }
            }else{
                $validated['image'] = $this->oldImage;
            }
        $product->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image' => $validated['image'],
        ]);
        $this->id='';
        $this->oldImage = $validated['image'];
        session()->flash('product_index', 'Product updated successfully.');
        $notification = array(
            'message' => 'Product updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('welcome')->with($notification);
        
}

}

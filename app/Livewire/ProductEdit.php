<?php

namespace App\Livewire;

use App\Models\category;
use App\Models\category_product;
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
        $this->category_id = category_product::where('product_id',$id)->pluck('category_id')->toArray();
       
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        $categorys = category::get();
        return view('livewire.product-edit', compact('categorys'));
    }
    public function update(){
        $validated = $this->validate();
        $product = Product::findOrFail($this->id);
        if($this->image){
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
        category_product::where('product_id',$this->id)->delete();
        if ($this->category_id) {
            foreach ($this->category_id as $category_id) {
                category_product::create([
                    'category_id' => $category_id,
                    'product_id' => $this->id,
                ]);
            }
        }
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

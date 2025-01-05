<?php

namespace App\Livewire;

use App\Models\product;
use Livewire\Component;
use Livewire\Attributes\On;
class ProductIndex extends Component
{
    #[On("product_index")]
    public function render()
    {
        $products=product::get();
        return view('livewire.product-index',compact('products'));
    }
    public function delete($id)
    {
        $product = product::find($id);
        if ($product->image) {
            try {
                unlink(storage_path('app/public/' .$product->image));                      
                } catch (\Exception $e) {             
                     
                }
        }
        $product->delete();
        session()->flash('product_index', 'product deleted successfully');
        $this->dispatch('product_index');
    }
}

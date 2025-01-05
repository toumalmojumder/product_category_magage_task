<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class productcard extends Component
{
    public $name;
    public $price;
    public $image;
    public $category;

    public $id;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $id , $price , $image)
    {
        $this->name = $name;
        $this->id = $id;
        $this->price = $price;
        $this->image = $image;
    }
   

    public function render(): View|Closure|string
    {
        return view('components.productcard');
    }
}

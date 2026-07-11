<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Preview extends Component
{
    protected $products;
    public $selectedProduct, $categories;
    

    public function mount()
    {
        $this->products = Product::all();
        $this->categories = Category::all();
    }

    public function render()
    {
        $this->products = Product::all();
        return view('livewire.admin.product.preview',
        [
            'selectedProduct' => $this->selectedProduct,
            'products' => $this->products,
            
        ]);
    }

    public function BackTo()
    {
        $this->selectedProduct = null;
    }
}

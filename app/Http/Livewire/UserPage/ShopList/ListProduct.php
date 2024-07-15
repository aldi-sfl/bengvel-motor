<?php

namespace App\Http\Livewire\UserPage\ShopList;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class ListProduct extends Component
{   
    // public $products;
    public $products = [];
    public $categories = [];
    public $searchTerm = '';
    public $readyToLoad = false;
    public $selectedProduct;

    public function loadProduct()
    {
        $this->readyToLoad = true;
    }
    public function updatedCategories()
    {
        $this->search();
    }
    
        // old render without filter
    // public function search()
    // {
    //     $this->products = Product::when($this->searchTerm, function ($query) {
    //         $query->where('name', 'like', '%'.$this->searchTerm.'%')
    //               ->orWhere('description', 'like', '%'.$this->searchTerm.'%');
    //     })->get();
    // }

    // public function render()
    // {
    //     $this->search(); // Ensure products are loaded initially
    //     return view('livewire.user-page.shop-list.list-product', [
    //         'products' => $this->readyToLoad ? product::all()
    //         : [],
    //     ]);
    // }
        // ==============
    
    // mixed search & filter
    // public function search()
    // {
    //     $this->products = Product::when($this->searchTerm, function ($query) {
    //         $query->where('name', 'like', '%'.$this->searchTerm.'%')
    //               ->orWhere('description', 'like', '%'.$this->searchTerm.'%');
    //     })->when($this->categories, function ($query) {
    //         $query->whereIn('category_id', $this->categories);
    //     })->get();
    // }

    public function search()
    {
        $this->products = Product::when($this->searchTerm, function ($query) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
        })->get();
    }

    public function filter()
    {
        $this->products = Product::when($this->categories, function ($query) {
            $query->whereIn('category_id', $this->categories);
        })->get();
    }
    
    

    public function render()
    {
        $this->search();
        $this->filter();

        return view('livewire.user-page.shop-list.list-product', [
            'products' => $this->readyToLoad ? $this->products : [],
            'allCategories' => Category::all(),
        ]);
        
    }

    public function addToCart($id){
        if (auth()->user()) {
            // Add to cart
            $data = [
                'user_id' => auth()->user()->id,
                'product_id' => $id,
            ];
    
            $cartItem = Cart::where($data)->first();
    
            if ($cartItem) {
                $cartItem->increment('quantity');
            } else {
                Cart::create($data);
            }
    
            $this->emit('updateCartCount');
            toastr()->success('Product added to the cart successfully', 'Congrats', ['timeOut' => 1000]);
        } else {
            
            return redirect(route('login'));
        }
    }

    public function getProduct($id)
    {
        $products = Product::find($id);

        if ($products) {
            $this->selectedProduct = $products;
        }
        // $this->emit('productSelected', $id);
        // session()->flash('success', 'click Product successfully '. $id);
    }
}

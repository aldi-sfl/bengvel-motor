<?php

namespace App\Http\Livewire\UserPage\ShopList;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;

class AddTocartButton extends Component
{
    public $product_id, $product;

    public function render()
    {
        // Fetch the product if needed
        $this->product = Product::find($this->product_id);
        return view('livewire.user-page.shop-list.add-tocart-button');
    }

    public function addToCart()
    {
        if (auth()->user()) {
            // Add to cart
            $data = [
                'user_id' => auth()->user()->id,
                'product_id' => $this->product_id,
            ];
    
            $cartItem = Cart::where($data)->first();
    
            if ($cartItem) {
                $cartItem->increment('quantity');
            } else {
                Cart::create($data);
            }
    
            $this->emit('updateCartCount');
            toastr()->success('Product added to the cart successfully', 'Congrats', ['timeOut' => 3500]);
        } else {
            return redirect(route('login'));
        }
    }
}

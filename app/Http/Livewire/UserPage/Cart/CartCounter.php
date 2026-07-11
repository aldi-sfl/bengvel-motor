<?php

namespace App\Http\Livewire\UserPage\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartCounter extends Component
{
    public $total = 0;
    protected $listeners = ['updateCartCount' => 'getCartItemCount'];

    public function render()
    {
        $this->getCartItemCount();
        return view('livewire.user-page.cart.cart-counter');
    }

    public function getCartItemCount(){
        $this->total = Cart::whereUserId(auth()->user()->id)
            // ->where('status', '!=', Cart::STATUS['success'])
            ->count();
    }
}

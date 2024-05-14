<?php

namespace App\Http\Livewire\UserPage\Cart;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class CartList extends Component
{
    public $products;
    public $cartitems, $sub_total = 0, $total = 0, $tax = 0;
    public $uuid, $product, $payment_method;
    public $selected_cart_items = [];
    public $checkAll = false;

    public  $deletionCompleted;

    public function rules()
    {
        return [
            'payment_method' => 'required|in:cash,transfer',
        ];
    }

    // random id in anotherItem even its exist in cart
    // public function render()
    // {
        
    //     $this->cartitems = Cart::with('product')
    //             ->where(['user_id'=>auth()->user()->id])
    //             ->where('status', '!=', Cart::STATUS['success'])
    //             ->get();


    //             $selectedCartItems = $this->cartitems->filter(function ($item) {
    //                 return in_array($item->id, $this->selected_cart_items);
    //             });
            
    //             // $this->total = 0;
    //             $this->sub_total = 0;
    //             $this->tax = 0;
            
    //             foreach ($selectedCartItems as $item) {
    //                 $this->sub_total += $item->product->price * $item->quantity;
    //             }
    //     $this->total = $this->sub_total - $this->tax;
    //     $this->products = Product::inRandomOrder()->take(3)->get();
    //     return view('livewire.user-page.cart.cart-list');
    // }

    // anotherItem is exclude from cart 
    public function render()
    {
        // Get all cart items for the current user
        $this->cartitems = Cart::with('product')
            ->where(['user_id' => auth()->user()->id])
            ->where('status', '!=', Cart::STATUS['success'])
            ->get();

        // Extract product IDs from cart items
        $cartProductIds = $this->cartitems->pluck('product_id')->toArray();

        // Query products excluding those already in the cart
        $this->products = Product::whereNotIn('id', $cartProductIds)
            ->inRandomOrder()
            ->take(3)
            ->get();

        // Calculate total and other cart related data
        
        $selectedCartItems = $this->cartitems->filter(function ($item) {
            return in_array($item->id, $this->selected_cart_items);
        });
        $this->sub_total = 0;
        $this->tax = 0;
        foreach ($selectedCartItems as $item) {
            $this->sub_total += $item->product->price * $item->quantity;
        }
        
        $this->total = $this->sub_total - $this->tax;

        return view('livewire.user-page.cart.cart-list');
    }


    public function checkout(){
        if (empty($this->selected_cart_items)) {
            
            return;
        }
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();
           
            $selectedCartItems = $this->cartitems->filter(function ($item) {
                return in_array($item->id, $this->selected_cart_items);
            });
    
            $this->total = 0;
            $this->sub_total = 0;
            $this->tax = 0;
            foreach ($selectedCartItems as $item) {
                $this->sub_total += $item->product->price * $item->quantity;
            }
        
            $uuid = Str::uuid();

            $transaction = Transaction::create([
                'user_id' => auth()->user()->id,
                'code_invoice' => $uuid,
                'grand_total' => $this->sub_total,
                'transaction_status' => 'pending',
                'method_payment' => $this->payment_method,
            ]);
            

            // useless
            // $this->emit('codeInvoiceGenerated', $uuid);

           
            foreach ($selectedCartItems as $cart) {
                $product = $cart->product;
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product' => $product->id,
                    'product_id' => $product->id,
                    'qty' => $cart->quantity,
                    'price' => $product->price,
                ]);

                $current_stock = $product->stock - $cart->quantity;
                $product->update([
                    'stock' => $current_stock,
                ]);

                $cart->delete();
            }


            DB::commit();
            $this->emit('updateCartCount');
            session()->flash('success', 'Checkout berhasil!');
            return redirect('/transaction');
            // return redirect('/transaction')->with('success', 'Checkout success!');

        } catch (\Exception $e) {
            DB::rollback();

            session()->flash('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }
    
    public function checkAllItems()
    {
        if ($this->checkAll) {
            $this->selected_cart_items = $this->cartitems->pluck('id')->toArray();
        } else {
            $this->selected_cart_items = [];
        }
    }

    public function incrementQty($id)
    {
        $cart = Cart::whereId($id)->first();
        $cart->quantity += 1;
        $cart->save();

        session()->flash('success', 'Jumlah produk berhasil diubah!');
    }

    public function decrementQty($id)
    {
        $cart = Cart::whereId($id)->first();
        if($cart->quantity > 1){
            $cart->quantity -= 1;
            $cart->save();
            session()->flash('success', 'Jumlah produk berhasil diubah!');
        }else{
            session()->flash('error','Jumlah barang tidak boleh kurang dari 1!');
        }
    }

    public function removeItem($id)
    {
        $cart = Cart::whereId($id)->first();

        if($cart){
            $cart->delete();
            $this->emit('updateCartCount');
        }
        session()->flash('success', 'Produk telah dihapus dari keranjang');
    }

    public function deleteSelectedItems()
    {
        Cart::whereIn('id', $this->selected_cart_items)->delete();
        $this->deletionCompleted = true;
        // dd($this->deletionCompleted);
        $this->emit('updateCartCount');
        session()->flash('success', 'Produk yang dipilih telah dihapus dari keranjang');
        // $this->selectAll = false;
        $this->deletionCompleted = false;
        $this->selected_cart_items = [];
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
            toastr()->success('Product added to the cart successfully', 'Congrats', ['timeOut' => 3500]);
        } else {
            
            return redirect(route('login'));
        }
    }



    
}

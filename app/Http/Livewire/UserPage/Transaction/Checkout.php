<?php

namespace App\Http\Livewire\UserPage\Transaction;

use App\Models\Cart;
use App\Models\dataBank;
use App\Models\Product;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\ConnectionException;

class Checkout extends Component
{
    public $transaction;
    public $total = 0;
    public $grandTotal = 0;
    public $checkWeight;
    public $list_payment;

    // public $id;
    public $shippingMethod;
    public $payment_method;
    public $address;
    public $phone;
    public $shippings;
    public $fromCities = [];
    public $toCities = [];
    public $provinces = [];
    public $fromCity;
    public $toCity;
    public $fromProvince;
    public $toProvince;
    public $weight;
    public $courier;
    public $costResult;
    public $selectedShippingService;
    public $selectedShippingPrice;
    public $selectedProvinceName;
    public $selectedCityName;
    public $avatar;

    // public $accordionState = [];
    public $accordionState = [
        'transfer' => false,
    ];

    public function mount($id)
    {
        $this->avatar = session('avatar');
        $user = auth()->user();
        $this->address = $user->address;
        $this->phone = $user->phone;
        $this->transaction = Transaction::with(['transactionDetails.product','user'])->findOrFail($id);
        foreach ($this->transaction->transactionDetails as $detail) {
            $this->total += $detail->price * $detail->quantity;
        }
        $this->calculateTotalWeight();

        $this->list_payment = dataBank::all();
        $this->payment_method = $this->transaction->method_payment;
        // $this->accordionState = [
        //     'e_wallet' => in_array($this->payment_method, ['dana', 'gopay']),
        //     'bank_transfer' => in_array($this->payment_method, ['bca', 'bri']),
        // ];
    }

    public function updatedPaymentMethod()
    {
        $this->accordionState['transfer'] = true;
    }

    public function calculateTotalWeight()
    {
        // Retrieve cart items
        $cartItems = Cart::where('user_id', auth()->id())->get();

        // Calculate total weight
        $totalWeight = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->weight * $cartItem->quantity;
        });

        // Set the total weight to the public property
        $this->weight = $totalWeight;
    }
    
    public function render()
    {
        
        return view('livewire.user-page.transaction.checkout')
                ->extends('layouts.cart-layout.app',[
                    'avatar' => $this->avatar
                ])
                ->section('content');
    }


    public function updatedShippingMethod($value)
    {
        if ($value == 'kirim-paket') {
            try {
                $responseProvince = Http::withHeaders([
                    'key' => '71e98a0e50be17a8751721d1d0f95ba4'
                ])->timeout(10)->get('https://api.rajaongkir.com/starter/province');
    
                if ($responseProvince->successful()) {
                    $this->provinces = $responseProvince['rajaongkir']['results'];
    
                    // Set fromProvince to the value at index 9
                    if (isset($this->provinces[9])) {
                        $this->fromProvince = $this->provinces[9]['province_id'];
                    }
    
                    // Fetch cities for the selected province
                    $this->updatedFromProvince($this->fromProvince);
    
                    // Set fromCity to the value at index 1 (after fetching cities)
                    if (isset($this->fromCities[1])) {
                        $this->fromCity = $this->fromCities[1]['city_id'];
                    }
                } else {
                    $this->handleFailedRequest('Failed to fetch provinces. Please try again later.');
                }
            } catch (ConnectionException $e) {
                $this->handleFailedRequest('Connection error: ' . $e->getMessage());
            } catch (RequestException $e) {
                $this->handleFailedRequest('Request error: ' . $e->getMessage());
            } catch (\Exception $e) {
                $this->handleFailedRequest('An unexpected error occurred: ' . $e->getMessage());
            }
        }else{
            $this->address = null;

        }
    }

    private function handleFailedRequest($errorMessage)
    {
       
        $this->provinces = [];
        $this->fromProvince = null;
        $this->fromCities = [];
        $this->fromCity = null;
        session()->flash('error', $errorMessage);
    }

    public function updatedFromProvince($value)
    {
        if ($value) {
            $responseCity = Http::withHeaders([
                'key' => '71e98a0e50be17a8751721d1d0f95ba4'
            ])->get('https://api.rajaongkir.com/starter/city', [
                'province' => $value
            ]);

            if ($responseCity->successful()) {
                $this->fromCities = $responseCity['rajaongkir']['results'];
                // Reset fromCity if the province changes
                $this->fromCity = $this->fromCities[1]['city_id'] ?? null;
            }
        } else {
            $this->fromCities = [];
            $this->fromCity = null;
        }
    }

    public function updatedtoProvince($value)
    {
        if ($value) {
            $responseCity = Http::withHeaders([
                'key' => '71e98a0e50be17a8751721d1d0f95ba4'
            ])->get('https://api.rajaongkir.com/starter/city', [
                'province' => $value
            ]);

            if ($responseCity->successful()) {
                $this->toCities = $responseCity['rajaongkir']['results'];
                $this->selectedProvinceName = $this->provinces[array_search($value, array_column($this->provinces, 'province_id'))]['province'];
                // $this->selectedCityName = $this->toCities[array_search($value, array_column($this->toCities, 'city_id'))]['city_name'];
            }
        } else {
            $this->toCities = [];
        }
    }

    public function updatedtoCity($value)
    {
        if ($value) {
            $city = collect($this->toCities)->firstWhere('city_id', $value);
            if ($city) {
                $this->selectedCityName = $city['city_name'];
            }
        } else {
            $this->selectedCityName = null;
        }
    }

    public function check()
    {
        $this->validate([
            'fromProvince' => 'required|not_in:Pilih Provinsi',
            'fromCity' => 'required|not_in:Pilih Kota Asal',
            'toProvince' => 'required|not_in:Pilih Provinsi',
            'toCity' => 'required|not_in:Pilih Kota Asal',
            'weight' => 'required|numeric|min:1',
            'courier' => 'required|not_in:Pilih-Kurir',
        ]);
        
        $responseCost = Http::withHeaders([
            'key' => '71e98a0e50be17a8751721d1d0f95ba4'
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $this->fromCity,
            'destination' => $this->toCity,
            'weight' => $this->weight,
            'courier' => $this->courier,
        ]);

        $this->costResult = $responseCost->json();
        // dd($this->costResult);
        toastr()->success('Data has been saved successfully!');
        return;
        
    }

    // public function updatedPaymentMethod($value)
    // {
    //     // Update accordion state based on selected payment method
    //     $this->accordionState = [
    //         'e_wallet' => in_array($value, ['dana', 'gopay']),
    //         'bank_transfer' => in_array($value, ['bca', 'bri']),
    //     ];
    // }

    public function updatedSelectedShippingService($value)
    {
        foreach ($this->costResult['rajaongkir']['results'] as $item) {
            foreach ($item['costs'] as $cost) {
                foreach ($cost['cost'] as $detail) {
                    if ($cost['service'] === $value) {
                        $this->selectedShippingPrice = $detail['value'];
                        return;
                    }
                }
            }
        }
    }


    
    // public function makeAnOrder()
    // {
    //     $this->validate([
    //         'shippingMethod' => 'required',
    //         'payment_method' => 'required|string',
    //     ]);

    //     $transactionDetail = $this->transaction->transactionDetails->first();

    //     if ($transactionDetail) {
    //         Shipping::create([
    //             'transaction_detail_id' => $transactionDetail->id,
    //             'shipping_method' => $this->shippingMethod,
    //             'address' => $this->shippingMethod == 'kirim-paket' ? $this->address : null,
    //             // Add 'courier_service' and 'service_price' if needed
    //         ]);
    //     } else {
    //         session()->flash('error', 'No transaction details found for this transaction.');
    //         return;
    //     }
    //     $this->transaction->update([
    //         'method_payment' => $this->payment_method,
    //     ]);
    //     $this->updatedPaymentMethod($this->payment_method);

    //     toastr()->success('Data has been saved successfully!', 'Congrats',['timeOut' => 3500]);
    //     session()->flash('message', 'Payment method updated successfully.');
    // }

    public function makeAnOrder()
    {

        $this->validate([
            'address' => 'required_if:shippingMethod,kirim-paket',
            'phone' => 'required_if:shippingMethod,kirim-paket',
            'shippingMethod' => 'required',
            'payment_method' => 'required|string',
            'courier' => 'required_if:shippingMethod,kirim-paket',
            'selectedShippingService' => 'required_if:shippingMethod,kirim-paket',
            'selectedShippingPrice' => 'required_if:shippingMethod,kirim-paket',
        ]);

        // $transactionDetail = $this->transaction->transactionDetails->first();
        $userId = auth()->id();
        $transaction = Transaction::where('user_id', $userId)->latest()->first();
        $selectedCartItems = Session::get('selected_cart_items', []);

        if ($transaction) {
            $formattedAddress = $this->address . ', ' . $this->selectedCityName . ', ' . $this->selectedProvinceName;

            $this->grandTotal = $this->transaction->transactionDetails->sum(function($detail) {
                return $detail->price * $detail->quantity;
            });
            if ($this->shippingMethod == 'kirim-paket') {
                $this->grandTotal += $this->selectedShippingPrice;
            }
            Shipping::updateOrCreate([
                'transaction_id' => $transaction->id,
                'shipping_method' => $this->shippingMethod,
                'address' => $this->shippingMethod == 'kirim-paket' ? $formattedAddress : null,
                'phone' => $this->phone,
                'courier_provider' => $this->courier,
                'couries_service' => $this->selectedShippingService,
                'servicce_price' => $this->selectedShippingPrice,
            ]);
            
            $this->transaction->update([
                'method_payment' => $this->payment_method,
                'total_amount' => $this->grandTotal,
                ]);
                $this->updatedPaymentMethod($this->payment_method);
                // delete cart item after make order
                foreach ($selectedCartItems as $cartItemId) {
                    $cartItem = Cart::find($cartItemId);
                    $product = Product::find($cartItem->product_id);
        
                    $product->decrement('stock', $cartItem->quantity);
                    $cartItem->delete();
                }
            
        } else {
            // session()->flash('error', 'No transaction details found for this transaction.');
            toastr()->error('An error has occurred please try again later.');
            return;
        }

        toastr()->success('Data has been saved successfully!', 'Congrats', ['timeOut' => 1000]);
        return redirect()->route('payment', ['id' => $transaction->id]);
        // session()->flash('message', 'Payment method updated successfully.');
    }


    public function redirectToCart()
    {
        $latestTransaction = Transaction::latest()->first();

        if ($latestTransaction) {
            $latestTransaction->delete();
            // toastr()->success('Latest transaction data deleted successfully.');
            return redirect()->to('/cart');
        } else {
            // toastr()->error('No transaction data found.');
        }
    }

   
}

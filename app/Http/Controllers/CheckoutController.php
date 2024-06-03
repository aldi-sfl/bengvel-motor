<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Log;

class CheckoutController extends Controller
{
    //
    
    public function index($id) 
    {
        $total = 0;
        $transaction = Transaction::with('transactionDetails.product')->findOrFail($id);
        foreach($transaction->transactionDetails as $detail){
            $total += $detail->price * $detail->quantity;
        }

      
        return view('pages.User.transaction.checkout', compact('transaction', 'total'));
    }

    public function OngkirCheck(Request $request)
    {
        
        // cek kota 
        $response = Http::withHeaders([
            'key' => '71e98a0e50be17a8751721d1d0f95ba4'
        ])->get('https://api.rajaongkir.com/starter/city');

        $responseCost = Http::withHeaders([
            'key' => '71e98a0e50be17a8751721d1d0f95ba4'
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $request->origin, 
            'destination' => $request->destination, 
            'weight' => $request->weight, 
            'courier' => $request->courier, 
        ]);

        dd($responseCost->json());

        $cities = $response['rajaongkir']['results'];
        return view('pages.User.transaction.checkout', compact('transaction', 'cities'));
    }
}

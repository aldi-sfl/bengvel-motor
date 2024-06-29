<?php

namespace App\Http\Controllers;

use App\Models\dataBank;
use Illuminate\Http\Request;

class Payment_MethodController extends Controller
{
    
    public function index()
    {
        $list_payment = dataBank::all();
        return view('pages.admin.payment_method',[
            'list_payment' => $list_payment
        ]);    
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'bank_account' => 'required|string|max:255',
            'atas_nama' => 'required|string|max:255',
        ]);

        $paymentMethod = new dataBank();
        $paymentMethod->bank_name = $request->input('bank_name');
        $paymentMethod->bank_account = $request->input('bank_account');
        $paymentMethod->atas_nama = $request->input('atas_nama');
        $paymentMethod->save();

        toastr()->success('metode pembayaran telah di tambah!', 'Success', ['timeOut' => 3500]);
        return redirect()->route('list-payment.store');
    }


    public function edit($id)
    {
        $paymentMethod = dataBank::findOrFail($id);
        $list_payment = dataBank::all();
        return view('pages.admin.payment_method', [
            'paymentMethod' => $paymentMethod,
            'list_payment' => $list_payment
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'bank_account' => 'required|string|max:255',
            'atas_nama' => 'required|string|max:255',
        ]);

        $paymentMethod = dataBank::findOrFail($id);
        $paymentMethod->bank_name = $request->input('bank_name');
        $paymentMethod->bank_account = $request->input('bank_account');
        $paymentMethod->atas_nama = $request->input('atas_nama');
        $paymentMethod->save();

        // return redirect()->route('list-payment')->with('success', 'Payment method updated successfully.');
        toastr()->success('metode pembayaran telah di perbarui!', 'Success', ['timeOut' => 3500]);
        return redirect()->route('list-payment.store');
    }

    public function destroy($id)
    {
        $paymentMethod = dataBank::findOrFail($id);
        $paymentMethod->delete();

        
        toastr()->success('data telah dihapus', 'Success', ['timeOut' => 3500]);
        return redirect()->route('list-payment.store');
    }
}

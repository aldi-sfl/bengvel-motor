<?php

namespace App\Http\Controllers;

use App\Models\dataBank;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class paymentController extends Controller
{
    
    public function index($id)
    {
        $userId = Auth::id();
        $transaction = Transaction::with('user')->where('id', $id)->where('user_id', $userId)->first();

        if (!$transaction) {
            abort(404);
        }
        $bankName = $transaction->method_payment;
        $paymentMethod = dataBank::where('bank_name', $bankName)->first();

        $title = 'pembayaran - Orbit Motor';
        return view('pages.User.transaction.payment',[
            'transaction' => $transaction,
            'paymentMethod' => $paymentMethod,
            'title' => $title
        ]);
    }
    // public function index($id)
    // {
    //     $futureDate = Carbon::now()->addMinute(1);
    //     $userId = Auth::id();
    //     $transaction = Transaction::with('user')->where('id', $id)->where('user_id', $userId)->first();

    //     if (!$transaction) {
    //         abort(404);
    //     }
    //     // $transaction = Transaction::with('user')->find($id);
    //     $title = 'pembayaran - Orbit Motor';
    //     return view('pages.User.transaction.payment',[
    //         'transaction' => $transaction,
    //         'title' => $title,
    //         'futureDate' => $futureDate
    //     ]);
    // }
    // public function cancelTransaction(Request $request)
    // {
    //     $transactionId = $request->input('transaction_id');
    //     $transaction = Transaction::find($transactionId);

    //     if ($transaction) {
    //         $transaction->transaction_status = 'canceled';
    //         $transaction->save();
    //         return response()->json(['status' => 'success', 'message' => 'Transaction canceled.']);
    //     }

    //     return response()->json(['status' => 'error', 'message' => 'Transaction not found.'], 404);
    // }
}

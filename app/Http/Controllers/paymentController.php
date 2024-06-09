<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class paymentController extends Controller
{
    //
    public function index($id)
    {
        $userId = Auth::id();
        $transaction = Transaction::with('user')->where('id', $id)->where('user_id', $userId)->first();

        // If the transaction is not found or does not belong to the authenticated user, abort with a 404 error
        if (!$transaction) {
            abort(404);
        }
        // $transaction = Transaction::with('user')->find($id);
        $title = 'pembayaran - Orbit Motor';
        return view('pages.User.transaction.payment',[
            'transaction' => $transaction,
            'title' => $title
        ]);
    }
}

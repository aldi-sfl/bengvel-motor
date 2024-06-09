<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListOrderController extends Controller
{
    //
    public function index()
    {
        $userId = Auth::id();
        $avatar = session('avatar');
        $listOrders = Transaction::with('user')->where('user_id', $userId)->get();

        // $listOrder = Transaction::with('user')->find($id);
        $title = 'pesanan saya - Orbit Motor';
        return view('pages.User.myOrder.pesananSaya',[
            'listOrders' => $listOrders,
            'avatar' => $avatar,
            'title' => $title
        ]);
    }
}

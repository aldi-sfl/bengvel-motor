<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ListOrderController extends Controller
{
    //
    // public function index()
    // {
    //     $userId = Auth::id();
    //     $avatar = session('avatar');
    //     $listOrders = Transaction::with('user')->where('user_id', $userId)->get();

    //     // $listOrder = Transaction::with('user')->find($id);
    //     $title = 'pesanan saya - Orbit Motor';
    //     return view('pages.User.myOrder.pesananSaya',[
    //         'listOrders' => $listOrders,
    //         'avatar' => $avatar,
    //         'title' => $title
    //     ]);
    // }
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $userId = Auth::id();
        $avatar = session('avatar');
        $query = Transaction::with(['user','transactionDetails.product'])->where('user_id', $userId);
        switch ($filter) {
            case 'this_week':
                $query->where('created_at', '>=', Carbon::now()->startOfWeek());
                break;
            case 'this_month':
                $query->where('created_at', '>=', Carbon::now()->startOfMonth());
                break;
            case 'last_3_months':
                $query->where('created_at', '>=', Carbon::now()->subMonths(3));
                break;
            case 'last_6_months':
                $query->where('created_at', '>=', Carbon::now()->subMonths(6));
                break;
            case 'last_year':
                // $query->where('created_at', '>=', Carbon::now()->subYear());
                $query->where('created_at', '<', Carbon::now()->subYear());
                break;
            default:
                // No filter or unrecognized filter, show all orders
                break;
        }
        $listOrders = $query->get();
        // $listOrder = Transaction::with('user')->find($id);
        $title = 'pesanan saya - Orbit Motor';
        return view('pages.User.myOrder.pesananSaya',[
            'listOrders' => $listOrders,
            'avatar' => $avatar,
            'title' => $title
        ]);
    }

    public function view_pdf($id)
    {
        $userId = Auth::id();
        $avatar = session('avatar');
        // $listOrders = Transaction::with('user')->where('user_id', $userId)->get();
        $orders = Transaction::with(['user', 'transactionDetails.product'])->where('user_id', $userId)->where('id', $id) ->first();;
        // $pdf = Pdf::loadView('pages.User.transaction.invoice', ['listOrders' => $listOrders, 'avatar' => $avatar]);
        $pdf = Pdf::loadView('pages.User.transaction.invoice', ['orders' => $orders, 'avatar' => $avatar]);
        // return $pdf->download('invoice.pdf');
        return $pdf->stream('invoice.pdf');

    }

}

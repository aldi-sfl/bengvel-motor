<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
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
        $orderStatus = $request->query('order_status');
        $search = $request->query('search');
        $userId = Auth::id();
        $avatar = session('avatar');
        $query = Transaction::with(['user','transactionDetails.product.images'])->where('user_id', $userId);

        if ($search) {
            $query->whereHas('transactionDetails.product', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($orderStatus) {
            $query->where('transaction_status', $orderStatus);
        }
    
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


    public function buyAgain($id)
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect(route('login'));
        }

        // Fetch the ordered items from the specified transaction
        $orderedTransaction = Transaction::with(['transactionDetails.product'])
                                        ->where('user_id', $userId)
                                        ->where('id', $id)
                                        ->firstOrFail();

        // Iterate over each ordered item and add to the cart
        foreach ($orderedTransaction->transactionDetails as $detail) {
            $product = $detail->product;
            if ($product) {
                // Check if the product is already in the cart
                $cartItem = Cart::where(['user_id' => $userId, 'product_id' => $product->id])->first();

                if ($cartItem) {
                    // Increment the quantity if the product is already in the cart
                    $cartItem->increment('quantity', $detail->quantity);
                } else {
                    
                    Cart::create([
                        'user_id' => $userId,
                        'product_id' => $product->id,
                        'quantity' => $detail->quantity
                    ]);
                }
            }
        }

        

        
        return view('pages.User.Cart.shoppingCart');
    }


}

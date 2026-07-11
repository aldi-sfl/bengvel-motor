<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    //
    public function index($id)
    {
        $userId = Auth::id();
        $orders = Transaction::with(['user', 'transactionDetails.product','shipping'])->where('user_id', $userId)->where('id', $id)
        ->firstOrFail();

        // $listOrder = Transaction::with('user')->find($id);
        $title = 'invoice - Orbit Motor';
        // dd($orders);
        return view('pages.User.transaction.invoice',[
            'orders' => $orders,
            'title' => $title
        ]);
        
    }

    public function view_pdf($id)
    {
        $userId = Auth::id();
        $avatar = session('avatar');
        $orders = Transaction::with(['user', 'transactionDetails.product'])->where('user_id', $userId)->where('id', $id) ->first();
        if (!$orders) {
            return abort(404, 'Transaction not found.');
        }
        $userName = $orders->user->name;
        // Get transaction date in the format 'YYYYMMDD'
        $invoiceDate = $orders->created_at->format('Ymd');
        // Get transaction ID
        $transactionId = $orders->id;

        // Construct the PDF file name
        $pdfFileName = "{$userName}_invoice_{$invoiceDate}_{$transactionId}.pdf";

        $pdf = Pdf::loadView('pages.User.transaction.invoiceDownload', ['orders' => $orders, 'avatar' => $avatar]);
        // return $pdf->download('invoice.pdf');
        return $pdf->download($pdfFileName);
    }
}

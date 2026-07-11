<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionAdminController extends Controller
{

    public function index(Request $request)
    {
        $query = Transaction::with(['user','transactionDetails.product']);

        // Unified search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            // Check if the search is a date
            if (preg_match('/\d{4}-\d{2}-\d{2}/', $search)) {
                $query->whereDate('created_at', $search);
            } else {
                // Check if the search is a number (id)
                if (is_numeric($search)) {
                    $query->orWhere('id', $search);
                }
                // Otherwise, search by user name
                $query->orWhereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            }
        }

        $transaction_list = $query->get();

        return view('pages.admin.transactionAdmin',[
            'transaction_list' => $transaction_list
        ]);
    }

    public function changeStatus(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'transaction_status' => 'required|in:pending,success,cancelled',
        ]);

        // Find the transaction
        $transaction = Transaction::findOrFail($id);

        // Update the status
        $transaction->transaction_status = $request->input('transaction_status');
        $transaction->save();

        // Redirect back with a success message
        return redirect()->route('transaction')->with('success', 'Transaction status updated successfully.');
    }

    public function view_pdf($id)
    {
        $avatar = session('avatar');
        // $listOrders = Transaction::with('user')->where('user_id', $userId)->get();
        $orders = Transaction::with(['user', 'transactionDetails.product'])->where('id', $id) ->first();;
        // $pdf = Pdf::loadView('pages.User.transaction.invoice', ['listOrders' => $listOrders, 'avatar' => $avatar]);
        $pdf = Pdf::loadView('pages.User.transaction.invoice', ['orders' => $orders, 'avatar' => $avatar]);
        // return $pdf->download('invoice.pdf');
        // return $pdf->stream('invoice.pdf');
        return view('pages.User.transaction.invoice',[
            'orders' => $orders,
        ]);

    }

    public function download_pdf($id)
    {
        $avatar = session('avatar');
        $orders = Transaction::with(['user', 'transactionDetails.product'])->where('id', $id) ->first();
        if (!$orders) {
            return abort(404, 'Transaction not found.');
        }
       
        $invoiceDate = $orders->created_at->format('Ymd');
  
        $transactionId = $orders->id;

  
        $pdfFileName = "invoice_{$invoiceDate}_{$transactionId}.pdf";

        $pdf = Pdf::loadView('pages.User.transaction.invoiceDownload', ['orders' => $orders, 'avatar' => $avatar]);

        return $pdf->download($pdfFileName);
    }
}

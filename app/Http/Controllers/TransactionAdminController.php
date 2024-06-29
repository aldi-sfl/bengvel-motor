<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionAdminController extends Controller
{
    // public function index()
    // {   
    //     $transaction_list = Transaction::with(['user','transactionDetails.product'])->get();
    //     return view('pages.admin.transactionAdmin',[
    //         'transaction_list' => $transaction_list
    //     ]);
    // }
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
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    public function salesReport(Request $request)
    {
          // Get current month and year
          $currentMonth = date('m');
          $currentYear = date('Y');
  
          // Handle filter selection
          $filter = $request->input('filter', 'all'); // Default to 'all'
  
          // Determine start and end dates based on filter
          switch ($filter) {
              case 'last_month':
                  $startDate = Carbon::now()->subMonth()->startOfMonth();
                  $endDate = Carbon::now()->subMonth()->endOfMonth();
                  break;
              case 'last_2_months':
                  $startDate = Carbon::now()->subMonths(2)->startOfMonth();
                  $endDate = Carbon::now()->subMonths(1)->endOfMonth();
                  break;
              case 'last_3_months':
                  $startDate = Carbon::now()->subMonths(3)->startOfMonth();
                  $endDate = Carbon::now()->subMonths(1)->endOfMonth();
                  break;
              case 'last_year':
                  $startDate = Carbon::now()->subYear()->startOfYear();
                  $endDate = Carbon::now()->subYear()->endOfYear();
                  break;
              case 'all':
              default:
                  $startDate = null; // No start date set for 'all'
                  $endDate = Carbon::now(); // Today's date for 'all'
                  break;
          }
  
          // Query transactions based on the filter
          $transactionsQuery = Transaction::query();
  
          if ($startDate && $endDate) {
              $transactionsQuery->whereBetween('created_at', [$startDate, $endDate]);
          }
  
          $transactions = $transactionsQuery->get();
          $totalSales = $transactions->sum('total_amount');

        // Pass data to the view
        return view('pages.admin.dashboard.main', [
            'transactions' => $transactions,
            'totalSales' => $totalSales,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'filter' => $filter,
        ]);
    }
}

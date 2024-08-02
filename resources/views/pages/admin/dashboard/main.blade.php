@extends('pages.admin.layouts.app')

@section('main_content')
   
{{-- <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
    <div class="flex justify-between">
      <div>
        <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">32.4k</h5>
        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Users this week</p>
      </div>
      <div
        class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
        12%
        <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
        </svg>
      </div>
    </div>
    <div id="area-chart"></div>
    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
      <div class="flex justify-between items-center pt-5">
        <!-- Button -->
        <button
          id="dropdownDefaultButton"
          data-dropdown-toggle="lastDaysdropdown"
          data-dropdown-placement="bottom"
          class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
          type="button">
          Last 7 days
          <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
          </svg>
        </button>
        <!-- Dropdown menu -->
        <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
              </li>
            </ul>
        </div>
        <a
          href="#"
          class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
          Users Report
          <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
        </a>
      </div>
    </div>
</div> --}}

<div class="container mx-auto p-4">
  <h1 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">Sales Report</h1>

  <form action="{{ route('admin') }}" method="GET" class="mb-6">
      <label for="filter" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filter by:</label>
      <select id="filter" name="filter" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>All Time</option>
          <option value="last_month" {{ $filter == 'last_month' ? 'selected' : '' }}>Last Month</option>
          <option value="last_2_months" {{ $filter == 'last_2_months' ? 'selected' : '' }}>Last 2 Months</option>
          <option value="last_3_months" {{ $filter == 'last_3_months' ? 'selected' : '' }}>Last 3 Months</option>
          <option value="last_year" {{ $filter == 'last_year' ? 'selected' : '' }}>Last Year</option>
      </select>
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 w-full sm:w-auto">Apply Filter</button>
  </form>

  <p class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Total Sales: ${{ number_format($totalSales, 2) }}</p>

  <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                  <th scope="col" class="py-3 px-6">Transaction ID</th>
                  <th scope="col" class="py-3 px-6">User</th>
                  <th scope="col" class="py-3 px-6">Total Amount</th>
                  <th scope="col" class="py-3 px-6">Status</th>
                  <th scope="col" class="py-3 px-6">Payment Method</th>
                  <th scope="col" class="py-3 px-6">Date</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($transactions as $transaction)
                  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                      <td class="py-4 px-6">{{ $transaction->id }}</td>
                      <td class="py-4 px-6">{{ $transaction->user->name }}</td>
                      <td class="py-4 px-6">${{ number_format($transaction->total_amount, 2) }}</td>
                      <td class="py-4 px-6">{{ $transaction->transaction_status }}</td>
                      <td class="py-4 px-6">{{ $transaction->method_payment ?: 'N/A' }}</td>
                      <td class="py-4 px-6">{{ $transaction->created_at->format('Y-m-d H:i:s') }}</td>
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>
</div>


@endsection

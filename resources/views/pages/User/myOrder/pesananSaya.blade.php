@extends('layouts.apps')
@section('content')
<div class="container mx-auto px-5 mt-10 pt-10">
    <section class="bg-slate-200 rounded-lg py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
          <div class="mx-auto max-w-5xl">
            <div class="gap-4 sm:flex sm:items-center sm:justify-between">
              <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">My orders</h2>
      
              <div class="mt-2 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                
                                
                <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 bg-slate-200 dark:bg-gray-900">
                  <form class="flex items-center max-w-sm mx-auto" method="GET" action="{{ route('myOrder') }}">
                      <label for="simple-search" class="sr-only">Search</label>
                      <div class="relative w-full">
                          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
                              </svg>
                          </div>
                          <input type="text" name="search" id="simple-search" value="{{ request()->query('search') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search product name..."  />
                      </div>
                      
                      <div class="ml-4">
                          <label for="order-type" class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select order type</label>
                          <select name="order_status" id="order-type" class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                              <option value="" {{ request()->query('order_status') == '' ? 'selected' : '' }}>All orders</option>
                              <option value="pending" {{ request()->query('order_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                              <option value="success" {{ request()->query('order_status') == 'success' ? 'selected' : '' }}>Success</option>
                              <option value="cancelled" {{ request()->query('order_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                          </select>
                      </div>
                      <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                          <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                          </svg>
                          <span class="sr-only">Search</span>
                      </button>
                  </form>
                </div>
                
              
      
                <span class="inline-block text-gray-500 dark:text-gray-400"> from </span>
      
                <div class="filters mb-4">
                    <form action="{{ route('myOrder') }}" method="GET">
                        <label for="duration" class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select duration</label>
                        <select id="duration" name="filter" onchange="this.form.submit()" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                            <option value="">All Time</option>
                            <option value="this_week" {{ request('filter') == 'this_week' ? 'selected' : '' }}>This Week</option>
                            <option value="this_month" {{ request('filter') == 'this_month' ? 'selected' : '' }}>This Month</option>
                            <option value="last_3_months" {{ request('filter') == 'last_3_months' ? 'selected' : '' }}>The Last 3 Months</option>
                            <option value="last_6_months" {{ request('filter') == 'last_6_months' ? 'selected' : '' }}>The Last 6 Months</option>
                            <option value="last_year" {{ request('filter') == 'last_year' ? 'selected' : '' }}>Last Year</option>
                        </select>
                    </form>
                </div>
              </div>
            </div>
      
            <div class="mt-6 flow-root sm:mt-8">
              <div class="divide-y divide-gray-200 dark:divide-gray-700">
                {{-- @foreach ($listOrders as $item)
                <div class="gap-y-2 py-6 md:flex md:items-center md:gap-y-4 md:py-6 md:flex-nowrap sm:flex-wrap">
                  <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Order ID:</dt>
                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                      <a href="#" class="hover:underline">#{{ $item->id }}</a>
                    </dd>
                  </dl>
      
                  <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Date :</dt>
                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ $item->created_at->format('l, d M Y') }}
                    </dd>
                  </dl>
      
                  <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Price:</dt>
                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ 'Rp' . number_format($item->total_amount, 0, ',', '.') }}</dd>
                  </dl>
      
                  <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>
                    <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                      <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 4h-13m13 16h-13M8 20v-3.333a2 2 0 0 1 .4-1.2L10 12.6a1 1 0 0 0 0-1.2L8.4 8.533a2 2 0 0 1-.4-1.2V4h8v3.333a2 2 0 0 1-.4 1.2L13.957 11.4a1 1 0 0 0 0 1.2l1.643 2.867a2 2 0 0 1 .4 1.2V20H8Z" />
                      </svg>
                      {{ $item->transaction_status }}
                    </dd>
                  </dl>
      
                  <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                    <a href="{{ route('payment',['id' =>$item->id]) }}"><button type="button" class="w-full rounded-lg bg-primary-700 px-3 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 lg:w-auto">Bayar</button></a>
                    <a href="{{ route('details',['id' => $item->id]) }}" target="blank" class="w-full inline-flex justify-center rounded-lg  border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto">View details</a>
                    <a href="{{ route('view',['id' => $item->id]) }}" class="w-full inline-flex justify-center rounded-lg  border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto">View</a>
                  </div>
                </div>
                @endforeach --}}

                @forelse($listOrders as $order)
                  @php
                      $firstDetail = $order->transactionDetails->first();
                  @endphp
                <div class="py-4 flex items-center justify-center">
                  <div class="bg-slate-50  shadow-md rounded-lg p-4 w-full">
                      <div class="flex justify-between items-center mb-2">
                          <div class="flex items-center">
                             
                              <div>
                                  <div class="text-sm">{{ $order->created_at->format('l, d M Y') }}</div>
                              </div>
                              {{-- <span class="bg-green-300 text-xs px-2 py-1 rounded-lg ml-2">{{ $order->transaction_status }}</span> --}}
                              <label for="status" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Status
                                <dd class="me-2 mt-1.5 inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium
                                    @if($order->transaction_status == 'success')
                                        bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                    @elseif($order->transaction_status == 'cancelled')
                                        bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                    @elseif($order->transaction_status == 'pending')
                                        bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                    @endif
                                ">
                                    @if($order->transaction_status == 'success')
                                        <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                        </svg>
                                    @elseif($order->transaction_status == 'cancelled')
                                        <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                        </svg>
                                    @elseif($order->transaction_status == 'pending')
                                        <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                        </svg>
                                    @endif
                                    {{ $order->transaction_status }}
                                </dd>
                              </label>
                            
                            
                          </div>
                          <div class="text-sm font-medium text-gray-500">#{{ $order->id }}</div>
                      </div>
                      <div class="border-b border-gray-700 mb-4"></div>
                      <div class="flex items-center mb-4">
                          {{-- <img src="https://via.placeholder.com/60" alt="Product Image" class="w-16 h-16 rounded-lg mr-4"> --}}     
                           
                            @if($order->transactionDetails->isNotEmpty())
                                @php
                                    $detail = $order->transactionDetails->first();
                                @endphp
                        
                                @if($detail->product && $detail->product->images->first())
                                    <img alt="Product Image" class="w-16 h-16 rounded-lg mr-4" src="{{ asset('storage/' . $detail->product->images->first()->image_url) }}" title="{{ $detail->product->name }}">
                                @endif
                            @endif
                       
                          <div class="flex-1">
                              <div class="font-semibold">{{ $firstDetail->product->name }}</div>
                              <div class="text-sm text-gray-400">{{ $order->transactionDetails->count() }} barang</div>
                          </div>
                          <div class="text-right">
                              <div class="font-semibold text-gray-300">Total</div>
                              <div class="text-lg font-bold text-green-400">{{ 'Rp' . number_format($order->total_amount, 0, ',', '.') }}</div>
                          </div>
                      </div>
                      <div class="flex justify-end items-center gap-4">
                        <a href="{{ route('invoice',['id' => $order->id]) }}">
                              <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                lihat Detail 
                                </span>
                              </button> 
                          </a>
                          
                          @if($order->transaction_status == 'cancelled' || $order->transaction_status == 'success')
                          <form action="{{ route('beli-lagi', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                  Beli lagi                              
                            </button>
                          </form>
                          @elseif($order->transaction_status == 'pending')
                          <a href="{{ route('payment',['id' =>$order->id]) }}">
                              <button type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    Bayar                              
                              </button>
                          </a>
                          @endif
                          
                      </div>
                  </div>
                </div>
                @empty
                <p>tidak ada transaksi</p>

                @endforelse              
              </div>
            </div>
      
            {{-- <nav class="mt-6 flex items-center justify-center sm:mt-8" aria-label="Page navigation example">
              <ul class="flex h-8 items-center -space-x-px text-sm">
                <li>
                  <a href="#" class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only">Previous</span>
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                </li>
                <li>
                  <a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                </li>
                <li>
                  <a href="#" aria-current="page" class="z-10 flex h-8 items-center justify-center border border-primary-300 bg-primary-50 px-3 leading-tight text-primary-600 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                </li>
                <li>
                  <a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                </li>
                <li>
                  <a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                </li>
                <li>
                  <a href="#" class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only">Next</span>
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>
                  </a>
                </li>
              </ul>
            </nav> --}}
          </div>
        </div>
      </section>
</div>

<div class="mb-96">

</div>
@endsection
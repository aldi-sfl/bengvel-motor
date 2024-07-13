@extends('pages.admin.layouts.app')

@section('user_content')
    <section class="bg-slate-200 dark:bg-gray-900 p-3 sm:p-5">
        <h2 class="text-4xl font-bold dark:text-white flex flex-col justify-center items-center pb-6">Daftar metode pembayaran</h2>
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama Bank/E-wallet</th>
                            <th scope="col" class="px-4 py-3">No Rekening</th>
                            <th scope="col" class="px-4 py-3">Atas Nama</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_payment as $list )
                            <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $list->bank_name }}</th>
                                <td class="px-4 py-3">{{ $list->bank_account }}</td>
                                <td class="px-4 py-3">{{ $list->atas_nama }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <a href="{{ route('payment-methods.edit', $list->id) }}" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">Edit</a>
                                    <form action="{{ route('payment-methods.destroy', $list->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this payment method?');" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </section>

    {{-- form start --}}
    <section class="bg-slate-200 dark:bg-gray-900 pb-6">
    <div class=" bg-white shadow-md sm:rounded-lg py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
            @isset($paymentMethod)
                Edit Metode Pembayaran
            @else
                Tambah Metode Pembayaran
            @endisset
        </h2>
        {{-- <form action="{{ route('list-payment.store') }}" method="POST"> --}}
        <form action="{{ isset($paymentMethod) ? route('payment-methods.update', $paymentMethod->id) : route('list-payment.store') }}" method="POST">
            @csrf
            @isset($paymentMethod)
                @method('POST')
            @endisset
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <label for="bank_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama bank/e-wallet</label>
                    <input type="text" name="bank_name" id="bank_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ isset($paymentMethod) ? $paymentMethod->bank_name : '' }}" placeholder="Type bank/e-wallet name" required="">
                </div>
                <div class="sm:col-span-2">
                    <label for="bank_account" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Rekening</label>
                    <input type="text" name="bank_account" id="bank_account" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ isset($paymentMethod) ? $paymentMethod->bank_account : '' }}" placeholder="Type bank account" required="">
                </div>
                <div class="sm:col-span-2">
                    <label for="atas_nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Atas Nama</label>
                    <input type="text" name="atas_nama" id="atas_nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ isset($paymentMethod) ? $paymentMethod->atas_nama : '' }}" placeholder="Type name" required="">
                </div>
            </div>
            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                @isset($paymentMethod)
                    Update
                @else
                    Tambah
                @endisset
            </button>
        </form>
    </div>
    </section>    
    {{-- end of form --}}
    

@endsection
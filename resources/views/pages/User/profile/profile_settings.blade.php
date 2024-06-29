@extends('layouts.apps')
@section('content')
<div class="py-20  min-h-screen flex items-center justify-center">

<form method="POST" action="{{ route('profileUpdate') }}">
  @csrf
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <div class="flex flex-col items-center">
            @if(Auth::check() && Auth::user()->google_id == null)
                <div class="relative w-32 h-32 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                    <svg class="w-full h-full text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            @else
                <img class="rounded-full w-32 h-32 object-cover" src="{{ $avatar }}" alt="Profile Avatar">
            @endif
        </div>
        <h3 class="text-xl flex items-center justify-center py-4 mb-2 font-bold  text-gray-900"> {{ Auth::user()->name }}</h3>
        <h2 class="text-base font-semibold leading-7 text-gray-900">Email</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">{{ Auth::user()->email }}</p>
  
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-4">
            <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Nomor Handphone</label>
            <div class="mt-2">
              <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input type="number" name="phone" id="phone" value="{{ $users->phone }}" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="">
              </div>
              @error('phone')
                  <p class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          </div>
  
          <div class="col-span-full">
            <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Alamat</label>
            <div class="mt-2">
                <textarea id="address" name="address" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ $users->address }}</textarea>
            </div>
            @error('address')
                  <p class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
            <p class="mt-3 text-sm leading-6 text-gray-600">Tambahkan alamat dan nomor handphone untuk memudahkan dalam transaksi barang</p>
        </div>   
        </div>


      </div>
    </div>
  
    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
  </form>
  
</div>


@endsection
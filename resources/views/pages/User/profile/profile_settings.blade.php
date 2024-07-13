@extends('layouts.apps')
@section('content')
<div class="py-20  min-h-screen flex items-center justify-center bg-slate-200">

<form method="POST" action="{{ route('profileUpdate') }}">
  @csrf
    <div class="space-y-12 bg-white p-10 m-4">
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
        <div>
          <h2 class="text-base font-semibold leading-7 text-gray-900">Email</h2>
          <p class="mt-1 text-sm leading-6 text-gray-600">{{ Auth::user()->email }}</p>
          {{-- @include('partials.verifyEmail') --}}
          @auth
              @if (!auth()->user()->hasVerifiedEmail())
              <button type="button" class="btn-kembali relative text-sm font-thick text-purple-600 transition-colors duration-300 ease" id="verifyEmailButton">
                Verifikasi Email
                <span class="btn-kembali-after absolute left-1/2 bottom-[-4px] w-0 h-[1px] bg-orange-500 transition-all duration-300 ease-out"></span>
              </button>
                  @if (session('resent'))
                        {{-- <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div> --}}
                        <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                          <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                          </svg>
                          <span class="sr-only">Info</span>
                          <div>
                            <span class="font-medium">{{ __('A fresh verification link has been sent to your email address.') }}</span>
                          </div>
                        </div>
                  @endif
              {{-- @elseif (auth()->user()->google_id) --}}
              @else
              <span class="relative inline-flex items-center text-sm font-semibold text-green-300 transition-colors duration-300 ease">
                email terverifikasi
                <div class="ml-1 w-3.5 h-3.5">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
                    <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>
                  </svg>
                </div>
              </span>
              
              @endif
          @endauth
          
          <style>
            :root {
              --amikom-purple: #7e3af2;
              --amikom-orange: #ff5a1f;
            }
          
            .btn-kembali {
              color: var(--amikom-purple);
            }
          
            .btn-kembali:hover {
              color: var(--amikom-orange);
            }
          
            .btn-kembali:hover .btn-kembali-after {
              width: 100%;
              left: 0;
            }
          </style>
          
        </div>
  
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
            <p class="mt-3 text-sm leading-6 text-gray-600">Tambahkan alamat dan nomor handphone untuk memudahkan dalam pengiriman transaksi barang</p>
        </div>   
        </div>


      </div>
      <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="submit" class="rounded-md absolute bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
      </div>
    </div>
  
    
</form>

<form method="POST" action="{{ route('verification.resend') }}" id="emailVerificationForm" style="display: none;">
  @csrf
</form>

<script>
  document.getElementById('verifyEmailButton').addEventListener('click', function() {
      document.getElementById('emailVerificationForm').submit();
  });
</script>

  
</div>


@endsection
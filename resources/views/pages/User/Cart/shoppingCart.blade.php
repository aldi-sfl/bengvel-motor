@extends('layouts.cart-layout.app')
@section('content')
<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      {{-- include here --}}
      @livewire('user-page.cart.cart-list')

      {{-- -------- --}}
    </div>
</section>
@endsection
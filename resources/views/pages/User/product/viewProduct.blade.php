@extends('layouts.apps')
@section('content')


    <div class="container mx-auto px-5 mt-10 pt-10">
        @include('partials.breadcrumProduct')
        <div class="flex flex-col md:flex-row items-center md:items-start bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Image Section -->
            <div class="md:w-1/2 w-full p-4 ">
               @if(count($product->images) > 1)
                        <div id="product-carousel-{{ $product->id }}" class="relative w-full z-0" data-carousel="static">
                            <!-- Carousel wrapper -->
                            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                @foreach ($product->images as $index => $image)
                                    <div class="{{ $index == 0 ? 'block' : 'hidden' }} duration-700 ease-in-out" data-carousel-item="{{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ Storage::url($image->image_url) }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            </div>
                            <!-- Slider indicators -->
                            
                            <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse left-1/2">
                                @foreach ($product->images as $index => $image)
                                    <button type="button" class="w-3 h-3 rounded-full {{ $index == 0 ? 'bg-blue-500' : 'bg-white' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
                                @endforeach
                            </div>
                            <!-- Slider controls -->
                            <div class="relative">
                                <button type="button" class="absolute -top-48 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                        </svg>
                                        <span class="sr-only">Previous</span>
                                    </span>
                                </button>
                                <button type="button" class="absolute -top-48 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                        </svg>
                                        <span class="sr-only">Next</span>
                                    </span>
                                </button>
                            </div>
                            
                            <div class="hidden md:grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                                @foreach ($product->images as $image)
                                <div class="grid gap-4">
                                    <div>
                                        <img class="h-auto max-w-full rounded-lg" src="{{ Storage::url($image->image_url) }}" alt="">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            

                        </div>
                    @else
                        <img src="{{ Storage::url($product->images->first()->image_url) }}" class="w-full rounded-lg md:h-auto" alt="image not found" />
                    @endif
            </div>
            <!-- Details Section -->
            <div class="md:w-1/2 w-full p-6 bg-slate-200 mt-4 rounded-md">
                <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
                <div class="text-2xl font-semibold text-gray-900 mb-2">{{ 'Rp' . number_format($product->price, 0, ',', '.') }}</div>
                <div class="flex items-center mb-4">
                    <div class="flex items-center text-yellow-500">
                        <svg class="w-5 h-5 mx-2 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 80V229.5c0 17 6.7 33.3 18.7 45.3l176 176c25 25 65.5 25 90.5 0L418.7 317.3c25-25 25-65.5 0-90.5l-176-176c-12-12-28.3-18.7-45.3-18.7H48C21.5 32 0 53.5 0 80zm112 32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                    </div>
                    <span class="ml-2 text-gray-700">{{ $product->category->category_name }}</span>
                </div>
                <p class="text-gray-600 mb-4"> {{ $product->description }}</p>
                <div class="flex items-center text-green-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 10.172 7.707 8.879a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Stock: {{ $product->stock }}
                </div>
                
                @livewire('user-page.shop-list.add-tocart-button', ['product_id' => $product->id])
            </div>
        </div>
    </div>
    <div class="mb-80">
    </div>

@endsection
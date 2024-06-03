@extends('layouts.apps')
@section('content')


<div class="container mx-auto px-5 mt-10 pt-10">
    @include('partials.breadcrumProduct')
    <section class="bg-slate-300 md:py-16 dark:bg-gray-900 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
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
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                                @foreach ( $product->images as $image) 
                                <div class="grid gap-4">
                                    <div>
                                        <img class="h-auto max-w-full rounded-lg" src="{{ Storage::url($image->image_url) }}" alt="">
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    @else
                        <img src="{{ Storage::url($product->images->first()->image_url) }}" class="w-full rounded-lg md:h-auto" alt="{{ $product->name }} image not found" />
                    @endif
                    
                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        {{ $product->name }}
                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                            {{ 'Rp' . number_format($product->price, 0, ',', '.') }}
                        </p>
                        <p>
                            stok : {{ $product->stock }}
                        </p>
                    </div>
                    
                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                        
                        @livewire('user-page.shop-list.add-tocart-button', ['product_id' => $product->id])
                    </div>
    
                    <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />
                    <div class="flex item-center">
                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                            {{ $product->category->category_name }}
                        </p>
                        <svg class="w-5 h-5 mx-2 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 80V229.5c0 17 6.7 33.3 18.7 45.3l176 176c25 25 65.5 25 90.5 0L418.7 317.3c25-25 25-65.5 0-90.5l-176-176c-12-12-28.3-18.7-45.3-18.7H48C21.5 32 0 53.5 0 80zm112 32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                    </div>
                    <pre class="mb-6 text-gray-500 dark:text-gray-400 whitespace-pre-wrap overflow-auto">
                        {{ $product->description }}
                    </pre>
                </div>
            </div>
        </div>
    </section>
    
</div>

    {{-- just for footer white space --}}
    <div class="mb-80">
    </div>

@endsection
<div wire:init="loadProduct">
    {{-- In work, do what you enjoy. --}}
   
    <form class="max-w-md mx-auto px-4 pb-4" wire:submit.prevent="search">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" wire:model.debounce.300ms="searchTerm" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pencarian.. " required />
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>
    
    
   
    {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 p-4">
        
        @if($products->isEmpty())
            <p>No products found.</p>
        @else
        @foreach ($products as $item)
        <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="{{ url('/shop/product/' . $item->name . '/' . $item->hashed_id) }}">
                @if($item->images->first())
                        <img  class="rounded-t-lg" src="{{ asset('storage/' . $item->images->first()->image_url) }}" alt="image not found" title="{{ $item->name }}">
                @endif
            </a>
            <div class="px-5 pb-5">
                <a href="{{ url('/shop/product/' . $item->name . '/' . $item->hashed_id) }}">
                    <h5 class="pt-1 text-xl font-semibold tracking-tight text-gray-900 dark:text-white"> {{ $item->name }}</h5>
                </a>
                <div class="flex items-center m-2">
                   
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xl font-bold text-gray-900 dark:text-white">{{ 'Rp' . number_format($item->price, 0, ',', '.') }}</span>
                    <a href="#" wire:click="addToCart({{ $item->id }})" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Add to cart
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div> --}}
    <div id="drawer" class="fixed inset-y-0 left-0 w-64 bg-gray-100 p-4 transform -translate-x-full transition-transform duration-300 ease-in-out z-50">
        <button onclick="toggleDrawer()" class="mb-4  text-gray-700 hover:text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <h2 class="text-2xl font-bold mb-4">Filter</h2>
        <div class="mb-4">
            <h3 class="text-medium font-semibold mb-4 ">Category</h3>
            <ul class="text-left">
                @foreach ($allCategories as $category)
            <li>
                <div class="flex items-center mb-4">
                    <input id="category-{{ $category->id }}" type="checkbox" value="{{ $category->id }}" wire:model="categories" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="category-{{ $category->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }}</label>
                </div>
            </li>
            @endforeach
                
            </ul>
        </div>
    </div>

    <div class="flex h-full">
        <!-- Sidebar Filter for larger screens -->
        <div class="hidden md:block w-1/6 p-4 bg-slate-100 rounded-lg shadow-md ">
            <div class="h-full flex  justify-center ">
                <div class="p-6">
                    <div class="flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-7.414 7.414V21a1 1 0 01-1.447.894L9 20.382V13.12L1.293 6.707A1 1 0 011 6V4z" />
                        </svg>
                        <h2 class="text-2xl font-bold text-center mr-2">Filter</h2>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-medium font-semibold mb-4 ">Category</h3>
                        <ul class="text-left">
                            @foreach ($allCategories as $category)
                            <li>
                                <div class="flex items-center mb-4">
                                    <input id="category-{{ $category->id }}" type="checkbox" value="{{ $category->id }}" wire:model="categories" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="category-{{ $category->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->category_name }}</label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-4">
            <button onclick="toggleDrawer()" class="md:hidden mb-4 text-gray-700 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </button>
            @if($products->isEmpty())
                <p>No products found.</p>
            @else
                @foreach ($products as $item)
                    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="{{ url('/shop/product/' . $item->name . '/' . $item->hashed_id) }}">
                            @if($item->images->first())
                                <img class="rounded-t-lg" src="{{ asset('storage/' . $item->images->first()->image_url) }}" alt="image not found" title="{{ $item->name }}">
                            @endif
                        </a>
                        <div class="px-5 pb-5">
                            <a href="{{ url('/shop/product/' . $item->name . '/' . $item->hashed_id) }}">
                                <h5 class="pt-1 text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $item->name }}</h5>
                            </a>
                            <div class="flex items-center m-2"></div>
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-gray-900 dark:text-white">{{ 'Rp' . number_format($item->price, 0, ',', '.') }}</span>
                                <a href="#" wire:click="addToCart({{ $item->id }})" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        {{-- ============== --}}
    </div>

    {{-- drawerr settings --}}
    <script>
        function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            drawer.classList.toggle('drawer-open');
        }
    </script>
    <style>
        .drawer-open {
            transform: translateX(0);
        }
    </style>
    {{-- ================= --}}
    
    
</div>

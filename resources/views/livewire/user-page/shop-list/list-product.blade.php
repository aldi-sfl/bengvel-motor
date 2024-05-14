<div>
    {{-- In work, do what you enjoy. --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 p-4">
        @foreach ($products as $item)
        <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                @if($item->images->first())
                        <img  class="rounded-t-lg" src="{{ asset('storage/' . $item->images->first()->image_url) }}" alt="image not found" title="{{ $item->name }}">
                @endif
            </a>
            <div class="px-5 pb-5">
                <a href="#">
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
    </div>
    
</div>

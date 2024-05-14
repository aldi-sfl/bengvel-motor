@extends('layouts.apps')

@section('content')
<div class="grid grid-cols-2 gap-10">
    <!-- Product Image -->
    <div>
        <div class="bg-gray-900 h-96"></div> <!-- Placeholder for the image -->
    </div>

    <!-- Product Details -->
    <div>
        <h1 class="text-3xl font-bold">Apple iMac 24" All-In-One Computer, Apple M1, 8GB RAM</h1>
        <p class="text-yellow-400 mt-2">345 Reviews</p>
        <p class="text-green-400 mt-2">Deliver to Bonnie Green - Sacramento 23647</p>
        <div class="flex items-center justify-between mt-2">
            <span class="text-2xl font-semibold">$1,249.99</span>
            <input type="number" class="w-16 text-black" value="1">
        </div>
        <button class="bg-blue-600 px-5 py-2 mt-4 rounded hover:bg-blue-700">Add to cart</button>
        <div class="mt-4">
            <h2 class="font-bold">Color</h2>
            <div class="flex mt-2">
                <div class="w-6 h-6 bg-green-500 rounded-full mr-2"></div>
                <div class="w-6 h-6 bg-pink-500 rounded-full mr-2"></div>
                <div class="w-6 h-6 bg-gray-500 rounded-full mr-2"></div>
                <div class="w-6 h-6 bg-blue-500 rounded-full"></div>
            </div>
        </div>
        <div class="mt-4">
            <h2 class="font-bold">SSD capacity</h2>
            <select class="bg-gray-900 text-white mt-2 p-2">
                <option>256GB</option>
                <option>512GB</option>
                <option>1TB</option>
            </select>
        </div>
    </div>
</div>
@endsection
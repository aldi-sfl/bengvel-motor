<div>
    {{-- Do your work, then step back. --}}
    
    
    <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">

      @if (session()->has('error'))
      <div id="alert-3" class="flex p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Info</span>
        <div class="ml-3 text-sm font-medium">
          {{ session('error') }}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" onclick="closeAlert(event)" aria-label="Close">
          <span class="sr-only">Close</span>
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
      </div>
      @endif 
      
        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
          <div class="space-y-6">
            {{-- list cart --}}
            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
              <!-- Checkbox for selecting all products -->
              <div class="flex items-center justify-between p-3">
                  <div> 
                    <input wire:model="checkAll" wire:click="checkAllItems" type="checkbox" id="select-all" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    {{-- <label for="select-all" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Select All</label> --}}
                    <label for="select-all" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer hover:text-blue-500 dark:hover:text-blue-300">
                      Select All
                    </label>
                  
                  </div>
                  @if(count($selected_cart_items) > 0 && !$deletionCompleted)
                    <button wire:click.prevent="deleteSelectedItems" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                  @endif
              </div>      
                <!-- Individual product entry with checkbox -->
                @foreach ($cartitems as $item)
                <div wire:key="cart-item-{{ $item->id }}" class="mb-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                      <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">  
                        <!-- Product checkbox -->
                        <div class="flex items-center md:order-1 p-2">
                          <input wire:model="selected_cart_items" id="cart_check_{{ $item->id }}" type="checkbox" value="{{ $item->id }}" class="h-4 w-4 mr-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                      
                        <!-- Product image -->
                          <a href="{{ url('/shop/product/' . $item->product->name . '/' . $item->product->hashed_id) }}" class="shrink-0 md:order-1">
                            @if($item->product->images->first())
                                <img  class="h-20 w-20 dark:hidden object-cover" src="{{ asset('storage/' . $item->product->images->first()->image_url) }}" alt="image not found" title="{{ $item->name }}">
                            @endif
                          </a>  
                        </div>                              
                          <!-- Quantity and price controls -->
                          <div class="flex items-center justify-between md:order-4 md:justify-end">
                              <div class="flex items-center">
                                  <!-- Decrement button -->
                                  <button wire:click="decrementQty({{ $item->id }})" type="button" id="decrement-button" data-input-counter-decrement="counter-input" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                      <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                      </svg>
                                  </button>
                                  <!-- Quantity input -->
                                  <input type="text" id="counter-input" data-input-counter class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="{{ $item->quantity }}" disabled />
                                  <!-- Increment button -->
                                  <button  wire:click="incrementQty({{ $item->id }})" type="button" id="increment-button" data-input-counter-increment="counter-input" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                      <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                      </svg>
                                  </button>
                              </div>
                              <!-- Price display -->
                              <div class="text-end md:order-5 md:w-32">
                                  <p class="text-base font-bold text-gray-900 dark:text-white">Rp{{ $item->product->price }}</p>
                              </div>
                          </div>
          
                          <!-- Product description and actions -->
                          <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                              <!-- Product link -->
                              <a href="{{ url('/shop/product/' . $item->product->name . '/' . $item->product->hashed_id) }}" class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $item->product->name }}</a>
                              <!-- Action buttons -->
                              <div class="flex items-center gap-4">
                                  <!-- Remove button -->
                                  <button wire:click="removeItem({{ $item->id }})" type="button" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline hover:bg-red-100 rounded-lg   dark:text-red-500">
                                      <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                      </svg>
                                      Remove
                                  </button>
                              </div>
                          </div>
                      </div>
                </div>
                @endforeach
            </div>
            {{-- end list cart --}}
          </div>

          {{-- another item --}}
          <div class="hidden xl:mt-8 xl:block">
            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">People also bought</h3>
            <div class="mt-6 grid grid-cols-3 gap-4 sm:mt-8">
              @foreach ($products as $anotherItem)  
              <div class="mx-auto space-y-4 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <a href="{{ url('/shop/product/' . $anotherItem->name . '/' . $anotherItem->hashed_id) }}" class="overflow-hidden rounded">
                  {{-- <img class="mx-auto h-44 w-44 dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="imac image" /> --}}
                  @if($anotherItem->images->first())
                  {{-- <img  class="mx-auto h-44 w-44 dark:hidden" src="{{ asset('storage/' . $anotherItem->images->first()->image_url) }}" alt="image not found" title="{{ $anotherItem->name }}"> --}}
                  <div style="mx-20">
                    <img class="mx-auto object-cover h-full w-full dark:hidden" src="{{ asset('storage/' . $anotherItem->images->first()->image_url) }}" alt="image not found" title="{{ $anotherItem->name }}">
                </div>    
                  @endif
                </a>
                <div>
                  <a href="{{ url('/shop/product/' . $anotherItem->name . '/' . $anotherItem->hashed_id) }}" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $anotherItem->name }}</a>
                </div>
                <div>
                  <p class="text-lg font-bold text-gray-900 dark:text-white">
                    Rp{{ $anotherItem->price }}
                  </p>
                </div>
                <div class="mt-6 flex items-center gap-2.5">
                  <button wire:click="addToCart({{ $anotherItem->id }})" type="button" class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium  text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
                    </svg>
                    Add to cart
                  </button>
                </div>
              </div>
              @endforeach
              
            </div>
          </div>
        </div>
        
        {{-- checkout --}}
        <div class="sticky top-16 mx-auto mt-10 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
          <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
            <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>
  
            <div class="space-y-4">
              <div class="space-y-2">
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Total ({{ count($selected_cart_items) }} Produk )</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">{{ 'Rp' . number_format($sub_total, 0, ',', '.') }}</dd>
                </dl>
  
              <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                <dd class="text-base font-bold text-gray-900 dark:text-white">{{ 'Rp' . number_format($this->total, 0, ',', '.') }}</dd>
              </dl>
            </div>
  
            <button wire:click="checkout" type="submit"
              @if (empty($selected_cart_items)) 
              disabled class="cursor-not-allowed flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
              @endif
                class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Checkout
            </button>
            @if (session()->has('message'))
                <div>{{ session('message') }}</div>
            @endif
              @if (empty($selected_cart_items))
                <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Silahkan pilih produk yang ingin di beli</span></p>
              @endif
            <div class="flex items-center justify-center gap-2">
              <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
              <a href="/shop" title="" class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                Continue Shopping
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                </svg>
              </a>
            </div>
          </div>
        </div>
    </div>
      

    {{-- Do your work, then step back. --}}
</div>

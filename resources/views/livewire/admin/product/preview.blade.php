<div>

  
  @if ($selectedProduct)
  
        <button type="button" wire:click="BackTo" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0l3 4m-3-4l3-4"/>
          </svg>
          <span class="sr-only">back</span>
        </button>

        {{-- loading ga terlalu guna --}}
        <div wire:loading wire:target="BackTo">
          <div class="load-bar">
            <div class="bar"></div>
          </div>
          <style>
            .load-bar {
                        position: relative;
                        margin-top: 20px;
                        width: 100%;
                        height: 6px;
                        background-color: #fdba2c;
                      }
                      .bar {
                        content: "";
                        display: inline;
                        position: absolute;
                        width: 0;
                        height: 100%;
                        left: 50%;
                        text-align: center;
                      }
                      .bar:nth-child(1) {
                        background-color: #da4733;
                        animation: loading 3s linear infinite;
                      }
                      .bar:nth-child(2) {
                        background-color: #3b78e7;
                        animation: loading 3s linear 1s infinite;
                      }
                      .bar:nth-child(3) {
                        background-color: #fdba2c;
                        animation: loading 3s linear 2s infinite;
                      }
                      @keyframes loading {
                          from {left: 0; width: 0;z-index:100;}
                          33.3333% {left: 0; width: 100%;z-index: 10;}
                          to {left: 0; width: 100%;}
                      }
          </style>
        </div>
        {{-- end loading --}}
      
      
    {{-- Stop trying to control. --}}
    <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
          <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
            {{-- carousel --}}

            <div class="grid gap-4">
              <div>
                  {{-- main image --}}
                  @if($selectedProduct->images->first())
                      <a href="{{ asset('storage/' . $selectedProduct->images->first()->image_url) }}" target="_blank">
                          <img  class="h-auto max-w-full rounded-lg shadow-xl dark:shadow-gray-800" src="{{ asset('storage/' . $selectedProduct->images->first()->image_url) }}" alt="image not found" title="{{ $selectedProduct->name }}">
                      </a>
                  @endif
                  
              </div>
              <div class="grid grid-cols-5 gap-4">
                  {{-- second image --}}
                  @foreach($selectedProduct->images->skip(1) as $image)
                      <div>
                          <a href="{{ asset('storage/' . $image->image_url) }}" target="_blank">
                              <img class="h-auto max-w-full rounded-lg shadow-xl dark:shadow-gray-800" src="{{ asset('storage/' . $image->image_url) }}" alt="image not found" title="{{ $selectedProduct->name }}">
                          </a>
                      </div>
                  @endforeach
              </div>
          </div>
          
          

            {{-- end carousel --}}
            <div class="mt-6 sm:mt-8 lg:mt-0">
              <h1
                class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                {{ $selectedProduct->name }}
              </h1>
              <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                <p
                  class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                  Rp {{ $selectedProduct->price }}
                </p>
              </div>
              <p class="mb-4 mt-2 text-gray-500 dark:text-gray-400">
                Stock: {{ $selectedProduct->stock }}
              </p>
    
              <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />
    
              <p class="mb-6 text-gray-500 dark:text-gray-400">
                {{ $selectedProduct->description }}
              </p>
            </div>
          </div>
        </div>
      </section>

      {{-- <div wire:loading>
      </div> --}}
    
      
  @else
      @livewire('admin.product.index')
  @endif
  
</div>
